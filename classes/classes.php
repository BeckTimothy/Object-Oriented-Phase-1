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
	 * Activation token for this author;
	 **/
	private $authorActivationToken;
	/**
	 * Avatar URL for the author;
	 **/
	private $authorAvatarUrl;
	/**
	 *Email address for this author; this is unique data.
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

	/**
	 * accesor/getter method for author activation token
	 *
	 * @return string value of author activation token
	 */
	public function getAuthorActivationToken() {
		return($this->authorActivationToken);
	}
	/**
	 * mutator/setter method for author activation token
	 *
	 * @param string $newAuthorActivationToken
	 * @throws \InvalidArgumentException if token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the token is not a string
	 */
	public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
		//the above ?string is a nullable type which sanitized the parameter to either string or null
		//this is a void function that should not return any value
		if($newAuthorActivationToken === null) {
			$this->authorActivationToken = null;
			return;
		}
		//checks if token is valid
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//checks if token has 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}

	/**
	 * accesor/getter method for author avatar URL
	 *
	 * @return string value of author avatar URL
	 */
	public function getAuthorAvatarUrl() {
		return($this->authorAvatarUrl)
	}
	/**
	 * mutator/setter method for author avatar URL
	 *
	 * @param string $newAuthorAvatarUrl new value of author avatar url
	 * @throws InvalidArgumentException if $newAuthorAvatarUrl is not a string
	 */

}
?>