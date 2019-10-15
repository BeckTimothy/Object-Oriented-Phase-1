<?php
/**
 * Creating author generation class
 *
 * I believe I'm creating this php file to create a class that generates author objects.
 *
 * @author Timothy Beck <barricuda1993@yahoo.com>
 */
class author {
	/**
	 * id for this author; this is the primary key
	 **/
	private $authorId;
	/**
	 * Avatar URL for the author;
	 **/
	private $authorAvatarUrl;
	/**
	 *Activation token for this author;
	 **/
	private $authorActivationToken;
	/**
	 * Email address for this author; this is unique data.
	 **/
	private $authorEmail;
	/**
	 * hash containing password data for this author;
	 **/
	private $authorHash;
	/**
	 * Username for this author; this is unique data.
	 **/
	private $authorUsername;

	/**
	 * accesor/getter method for author id
	 *
	 * @return int value of author id
	 **/
	public function getAuthorId() {
		return($this->authorId);
	}

	/**
	 * mutator/setter method for author id
	 *
	 * @param int $newAuthorId new value of author id
	 * @throws UnexpectedValueException if $newAuthorId is not an integer
	 */
	public function setProfileId($newAuthorId) {
		//verify the author id is valid
		$newAuthorId = filter_var($newAuthorId, FILTER_VALIDATE_INT);
		if($newAuthorId === false) {
			throw(new UnexpectedValueException("profile id is not a valid integer"));
		}

		//convert and store the author id
		$this->authorId = intval($newAuthorId);
	}

}
?>