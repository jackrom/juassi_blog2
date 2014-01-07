<?php
/*
	Juassi 2.0 Spam Class
	Juan Carlos Reyes C Copyright 2012
*/
	class juassi_spam {

		private $comment_array = array();
		//private $comment_spam = false;
		//spam score
		private $comment_score = 0;

		function juassi_spam() {

		}

		//used to send an unchecked comment into the spam checker
		public function set_comment($comment_array) {

			$this->comment_array = $comment_array;

			if (!isset($this->comment_array['comment_type'])) $this->comment_array['comment_type'] = 'comment';

			switch($this->comment_array['comment_type']) {
				case 'trackback':
					$this->process_trackback();
				break;

				default:
					$this->process_comment();
			}
			return true;
		}

		//returns comment ready to be inserted into the database.
		function get_comment() {

			return $this->comment_array;
		}

		//standard comment form spam check
		private function process_comment() {

			juassi_run_section_ref('comment_spam_check', $this->comment_array);

			if (juassi_get_config('spam_level') != 0) {
				//add score for akismet
				if (juassi_get_config('akismet') && $this->is_akismet_spam()) {
					$this->add_comment_spam_score(juassi_get_config('akismet_weighting'));
					$this->comment_array['comment_akismet_spam'] = 1;
				}
				else {
					$this->comment_array['comment_akismet_spam'] = 0;
				}

				//add score for spam block
				if ($this->is_block_spam()) {
					$this->add_comment_spam_score(juassi_get_config('spam_block_weighting'));
				}
				//add score for commenter to hasn't posted before (based on email address)
				if ($this->user_has_not_commented_before()) {
					$this->add_comment_spam_score(juassi_get_config('user_commented_before_weighting'));
				}

				$this->comment_array['comment_spam_score'] = $this->get_comment_spam_score();

				//don't accept comment
				if ($this->get_comment_spam_score() >= juassi_get_config('max_spam_score')) juassi_stop('Your comment has been detected as spam and therefore will not be accepted.');

				//tag or don't accept comment comment
				if ($this->get_comment_spam_score() >= juassi_get_config('tag_spam_score')) {
					if (juassi_get_config('spam_level') == 2) {
						juassi_stop('Your comment has been detected as spam and therefore will not be accepted.');
					}
					elseif (juassi_get_config('spam_level') == 1) {
						$this->comment_array['comment_approved'] = 0;
					}
					else {
						$this->comment_array['comment_approved'] = 1;
					}
				}
				else {
					$this->comment_array['comment_approved'] = 1;
				}
			}
			else {
				$this->comment_array['comment_approved'] = 1;
				$this->comment_array['comment_akismet_spam'] = 0;
				$this->comment_array['comment_spam_score'] = 0;
			}
			return;
		}

		private function process_trackback() {

			juassi_run_section_ref('trackback_spam_check', $this->comment_array);

			if (juassi_get_config('spam_level') != 0) {
				//add score for akismet
				if (juassi_get_config('akismet') && $this->is_akismet_spam()) {
					$this->add_comment_spam_score(juassi_get_config('akismet_weighting'));
					$this->comment_array['comment_akismet_spam'] = 1;
				}
				else {
					$this->comment_array['comment_akismet_spam'] = 0;
				}
				$this->comment_array['comment_approved'] = 0;
				$this->comment_array['comment_spam_score'] = $this->get_comment_spam_score();
			}
			else {
				$this->comment_array['comment_approved'] = 1;
				$this->comment_array['comment_akismet_spam'] = 0;
				$this->comment_array['comment_spam_score'] = 0;
			}
			return;
		}

		function add_comment_spam_score($score) {

			$score = (int) $score;
			$this->comment_score = $this->comment_score + $score;
			return;
		}

		function get_comment_spam_score() {
			return (int) $this->comment_score;
		}

		function is_block_spam() {

			$key1 = $_POST['juassi_comment_spamblock'];
			$key2 = $_SESSION['juassi_comment_spamblock'];

			if ($key1 != $key2 OR empty($key2)) {
				return true;
			}
			else {
				return false;
			}
		}

		function is_akismet_spam() {

			$akismet = new Akismet(juassi_get_config('address'), juassi_get_config('akismet_api_key'), juassi_get_config('program_version'));

			$akismet->setCommentAuthor($this->comment_array['comment_display_name']);
			$akismet->setCommentAuthorEmail($this->comment_array['comment_email']);
			$akismet->setCommentAuthorURL($this->comment_array['comment_website']);
			$akismet->setCommentContent($this->comment_array['comment_body']);
			$akismet->setCommentType($this->comment_array['comment_type']);
			$akismet->setUserIP($this->comment_array['comment_ip_address']);

			if($akismet->isCommentSpam()) {
				return true;
			}
			else {
				return false;
			}
		}

		function user_has_not_commented_before() {
			global $juassi_db, $juassi_tb;

			if ($this->comment_array['user_id'] != 0) {
				$query = "SELECT count(*) FROM $juassi_tb->comments WHERE user_id = :user_id AND comment_approved = 1";

				$stmt = $juassi_db->prepare($query);

				$stmt->bindParam(':user_id', $this->comment_array['user_id']);

				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}

				$count = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($count['count(*)'] == 0) {
					return true;
				}
				else {
					return false;
				}
			}
			elseif (empty($this->comment_array['comment_email'])) {
				return true;
			}
			else {
				$query = "SELECT count(*) FROM $juassi_tb->comments WHERE comment_email = :comment_email AND comment_approved = 1";

				$stmt = $juassi_db->prepare($query);

				$stmt->bindParam(':comment_email', $this->comment_array['comment_email']);

				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}

				$count = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($count['count(*)'] == 0) {
					return true;
				}
				else {
					return false;
				}
			}
		}
	}
?>