<?php
/* Copyright (C) 2005-2010 IP2Location.com
 * All Rights Reserved
 *
 * This library is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; If not, see <http://www.gnu.org/licenses/>.
 */

require_once('ip2location.class.php');

$ip = new ip2location;
$ip->open('./databases/IP-COUNTRY-SAMPLE.BIN');

$record = $ip->getAll('35.1.1.1');

echo '<b>IP Address:</b> ' . $record->ipAddress . '<br>';
echo '<b>IP Number:</b> ' . $record->ipNumber . '<br>';
echo '<b>Country Short:</b> ' . $record->countryShort . '<br>';
echo '<b>Country Long:</b> ' . $record->countryLong . '<br>';
echo '<b>Region:</b> ' . $record->region . '<br>';
echo '<b>City:</b> ' . $record->city . '<br>';
echo '<b>ISP/Organisation:</b> ' . $record->isp . '<br>';
echo '<b>Latitude:</b> ' . $record->latitude . '<br>';
echo '<b>Longitude:</b> ' . $record->longitude . '<br>';
echo '<b>Domain:</b> ' . $record->domain . '<br>';
echo '<b>ZIP Code:</b> ' . $record->zipCode . '<br>';
echo '<b>Time Zone:</b> ' . $record->timeZone . '<br>';
echo '<b>Net Speed:</b> ' . $record->netSpeed . '<br>';
echo '<b>IDD Code:</b> ' . $record->iddCode . '<br>';
echo '<b>Area Code:</b> ' . $record->areaCode . '<br>';
echo '<b>Weather Station Code:</b> ' . $record->weatherStationCode . '<br>';
echo '<b>Weather Station Name:</b> ' . $record->areaCode . '<br>';
echo '<b>MCC:</b> ' . $record->mcc . '<br>';
echo '<b>MNC:</b> ' . $record->mnc . '<br>';
echo '<b>Mobile Brand:</b> ' . $record->mobileBrand . '<br>';
?>
<p><a href="http://www.ip2location.com"><img border=0 src="http://www.ip2location.com/images/ip2location468x60_0.gif"></a></p>
