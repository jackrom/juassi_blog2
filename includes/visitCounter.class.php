<?php
/*
 * phpcount.php Ver.1.1- An "anoymizing" hit counter.
 * Copyright (C) 2011  FireXware (firexware@gmail.com)
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/*
 * This PHP Class provides a hit counter that is able to track unique hits
 * without recording the visitor's IP address in the database. It does so by 
 * recording the hash of the IP address and page name.
 *
 * By hashing the IP address with page name as salt, you prevent yourself from
 * being able to track a user as they navigate your site. You also prevent 
 * yourself from being able to recover anyone's IP address without brute forcing
 * through all of the assigned IP address blocks in use by the internet.
 *
 * Contact: havoc AT defuse.ca
 * WWW:     https://defuse.ca/
 *
 * USAGE:
 *        In your script, use reqire_once() to import this script, then call the
 *        functions like PHPCount::AddHit(...); See each function for help.
 *
 * NOTE: You must set the database credentials in the InitDB method.
 */

class visitCount
{
   /*
    * Defines how many seconds a hit should be rememberd for. This prevents the
    * database from perpetually increasing in size. Thirty days (the default)
    * works well. If someone visits a page and comes back in a month, it will be
    * counted as another unique hit.
    */
    const HIT_OLD_AFTER_SECONDS = 1800; // default: 30 days.

    // Don't count hits from search robots and crawlers.
    const IGNORE_SEARCH_BOTS = true;

    // Don't count the hit if the browser sends the DNT: 1 header.
    const HONOR_DO_NOT_TRACK = false;

    private static $IP_IGNORE_LIST = array(
        '127.0.0.1',
    );

    private static $DB = false;

    private static function InitDB()
    {
        if(self::$DB)
            return;

        try
        {
            // TODO: Set the database login credentials.
            self::$DB = new PDO(
                'mysql:host=localhost;dbname=juassi',
                'root', // Username
                '', // Password
                array(PDO::ATTR_PERSISTENT => true)
            );
        }
        catch(Exception $e)
        {
            die('Failed to connect to phpcount database');
        }
    }

    /*
     * Adds a hit to a page specified by a unique $pageID string.
     */
    public static function AddHit($pageID)
    {
        if(self::IGNORE_SEARCH_BOTS && self::IsSearchBot())
            return false;
        if(in_array($_SERVER['REMOTE_ADDR'], self::$IP_IGNORE_LIST))
            return false;
        if(
            self::HONOR_DO_NOT_TRACK &&
            isset($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] == "1"
        ) {
            return false;
        }

        self::InitDB();

        self::Cleanup();
        self::CreateCountsIfNotPresent($pageID);
        if(self::UniqueHit($pageID))
        {
            self::CountHit($pageID, true);
            self::LogHit($pageID);
        }
        self::CountHit($pageID, false);

        return true;
    }
    
    /*
     * Returns (int) the amount of hits a page has
     * $pageID - the page identifier
     * $unique - true if you want unique hit count
     */
    public static function GetHits($pageID, $unique = false)
    {
        self::InitDB();

        self::CreateCountsIfNotPresent($pageID);

        $q = self::$DB->prepare(
            'SELECT hitcount FROM juassi2_hits
             WHERE pageid = :pageid AND isunique = :isunique'
        );
        $q->bindParam(':pageid', $pageID);
        $q->bindParam(':isunique', $unique);
        $q->execute();

        if(($res = $q->fetch()) !== FALSE)
        {
            return (int)$res['hitcount'];
        }
        else
        {
            die("Missing hit count from database!");
            return false;
        }
    }
    
    /*
     * Returns the total amount of hits to the entire website
     * When $unique is FALSE, it returns the sum of all non-unique hit counts
     * for every page. When $unique is TRUE, it returns the sum of all unique
     * hit counts for every page, so the value that's returned IS NOT the 
     * amount of site-wide unique hits, it is the sum of each page's unique
     * hit count.
     */
    public static function GetTotalHits($unique = false)
    {
        self::InitDB();

        $q = self::$DB->prepare(
            'SELECT hitcount FROM juassi2_hits WHERE isunique = :isunique'
        );
        $q->bindParam(':isunique', $unique);
        $q->execute();
        $rows = $q->fetchAll();

        $total = 0;
        foreach($rows as $row)
        {
            $total += (int)$row['hitcount'];
        }
        return $total;
    }
    
    /*====================== PRIVATE METHODS =============================*/
    
    private static function IsSearchBot()
    {
        // Of course, this is not perfect, but it at least catches the major
        // search engines that index most often.
        $keywords = array(
            'bot',
            'spider',
            'spyder',
            'crawlwer',
            'walker',
            'search',
            'yahoo',
            'holmes',
            'htdig',
            'archive',
            'tineye',
            'yacy',
            'yeti',
        );

        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        foreach($keywords as $keyword) 
        {
            if(strpos($agent, $keyword) !== false)
                return true;
        }

        return false;
    }

    private static function UniqueHit($pageID)
    {
        $ids_hash = self::IDHash($pageID);

        $q = self::$DB->prepare(
            'SELECT time FROM juassi2_nodupes WHERE ids_hash = :ids_hash'
        );
        $q->bindParam(':ids_hash', $ids_hash);
        $q->execute();

        if(($res = $q->fetch()) !== false)
        {
            if($res['time'] > time() - self::HIT_OLD_AFTER_SECONDS)
                return false;
            else
                return true;
        }
        else
        {
            return true;
        }
    }
    
    private static function LogHit($pageID)
    {
        $ids_hash = self::IDHash($pageID);

        $q = self::$DB->prepare(
            'SELECT time FROM juassi2_nodupes WHERE ids_hash = :ids_hash'
        );
        $q->bindParam(':ids_hash', $ids_hash);
        $q->execute();

        $curTime = time();

        if(($res = $q->fetch()) !== false)
        {
            $s = self::$DB->prepare(
                'UPDATE juassi2_nodupes SET time = :time WHERE ids_hash = :ids_hash'
            );
            $s->bindParam(':time', $curTime);
            $s->bindParam(':ids_hash', $ids_hash);
            $s->execute();
        }
        else
        {
            $s = self::$DB->prepare(
                'INSERT INTO juassi2_nodupes (ids_hash, time)
                 VALUES( :ids_hash, :time )'
            );
            $s->bindParam(':time', $curTime);
            $s->bindParam(':ids_hash', $ids_hash);
            $s->execute();
        }
    }
    
    private static function CountHit($pageID, $unique)
    {
        $q = self::$DB->prepare(
            'UPDATE juassi2_hits SET hitcount = hitcount + 1 ' .
            'WHERE pageid = :pageid AND isunique = :isunique'
        );
        $q->bindParam(':pageid', $pageID);
        $unique = $unique ? '1' : '0';
        $q->bindParam(':isunique', $unique);
        $q->execute();
    }
    
    private static function IDHash($pageID)
    {
        $visitorID = $_SERVER['REMOTE_ADDR'];
        return hash("SHA256", $pageID . $visitorID);
    }
    
    private static function CreateCountsIfNotPresent($pageID)
    {
        // Non-unique
        $q = self::$DB->prepare(
            'SELECT pageid FROM juassi2_hits WHERE pageid = :pageid AND isunique = 0'
        );
        $q->bindParam(':pageid', $pageID);
        $q->execute();

        if($q->fetch() === false)
        {
            $s = self::$DB->prepare(
                'INSERT INTO juassi2_hits (pageid, isunique, hitcount) 
                 VALUES (:pageid, 0, 0)'
            );
            $s->bindParam(':pageid', $pageID);
            $s->execute();
        }

        // Unique
        $q = self::$DB->prepare(
            'SELECT pageid FROM juassi2_hits WHERE pageid = :pageid AND isunique = 1'
        );
        $q->bindParam(':pageid', $pageID);
        $q->execute();

        if($q->fetch() === false)
        {
            $s = self::$DB->prepare(
                'INSERT INTO juassi2_hits (pageid, isunique, hitcount) 
                 VALUES (:pageid, 1, 0)'
            );
            $s->bindParam(':pageid', $pageID);
            $s->execute();
        }
    }
    
    private static function Cleanup()
    {
        $last_interval = time() - self::HIT_OLD_AFTER_SECONDS;

        $q = self::$DB->prepare(
            'DELETE FROM juassi2_nodupes WHERE time < :time'
        );
        $q->bindParam(':time', $last_interval);
        $q->execute();
    }
}