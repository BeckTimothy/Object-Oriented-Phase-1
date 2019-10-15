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
	 * @throws InvalidArgumentException if token is not a string or insecure
	 * @throws RangeException if the token is not exactly 32 characters
	 * @throws TypeError if the token is not a string
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
			throw(new RangeException("user activation is not valid"));
		}
		//checks if token has 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new RangeException("user activation token has to be 32"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/**
	 * accesor/getter method for author avatar URL
	 *
	 * @return string value of author avatar URL
	 */
	public function getAuthorAvatarUrl() {
		return($this->authorAvatarUrl);
	}
	/**
	 * mutator/setter method for author avatar URL
	 *
	 * @param string $newAuthorAvatarUrl new value of author avatar url
	 * @throws UnexpectedValueException if $newAuthorAvatarUrl is not a url
	 * @throws RangeException if url is longer than 255 characters
	 */
	public function setAuthorAvatarUrl($newAuthorAvatarUrl) {
		//checks if newAuthorAvatarUrl is a url
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_VALIDATE_URL);
		if($newAuthorAvatarUrl === false) {
			throw(new UnexpectedValueException("$newAuthorAvatarUrl is no a url"));
		}
		//checks if $newAuthorAvatarUrl is less than 255 length
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new RangeException("url needs to be less than 255 characters in length"));
		}
		$this->authorAuthorAvatarUrl = $newAuthorAvatarUrl;
	}
	/**
	 * accesor/getter method for author email
	 *
	 * @return string value of author email
	 */
	public function getAuthorEmail() {
		return($this->authorEmail);
	}
	/**
	 * mutator/setter method for author email
	 *
	 * @param string $newAuthorEmail
	 * @throws InvalidArgumentException if $newAuthorEmail is not valid email or insecure
	 * @throws RangeException if $newAuthorEmail is more than 128 char
	 * @throws TypeError if $newAuthorEmail is not a string
	 */
	public function setAuthorEmail(string $newAuthorEmail): void {
		//verify the email is secure and string
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new InvalidArgumentException("profile email is empty or insecure"));
		}
		//verify is email is not longer than 128 chars
		if(strlen($newAuthorEmail) > 128) {
			throw(new RangeException("Email is too long"));
		}
		$this->authorEmail = $newAuthorEmail;
	}
}
?>