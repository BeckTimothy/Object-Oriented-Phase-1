<?php
namespace BeckTimothy\ObjectOrientedPhase1;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/lib/vendor/autoload.php");
use Ramsey\Uuid\Uuid;
/**
 * Creating author generation class
 *
 * I'm creating this php file to create a class that generates author objects.
 *
 * @author Timothy Beck <barricuda1993@yahoo.com>
 */
class Author implements \JsonSerializable {
	//use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this author; this is the primary key
	 * @var Uuid $authorId
	 **/
	private $authorId;
	/**
	 * Activation token for this author;
	 * @var string $authorActivationToken
	 **/
	private $authorActivationToken;
	/**
	 * Avatar URL for the author;
	 * @var string $authorAvatarUrl
	 **/
	private $authorAvatarUrl;
	/**
	 *Email address for this author; this is unique data.
	 * @var string $authorEmail
	 **/
	private $authorEmail;
	/**
	 * hash containing password data for this author;
	 * @var string $authorHash
	 **/
	private $authorHash;
	/**
	 * Username for this author; this is unique data.
	 * @var string $authorUsername
	 **/
	private $authorUsername;
	/**
	 * accesor/getter method for author id
	 *
	 * @return Uuid value of author id
	 **/
	public function getAuthorId() : Uuid {
		return($this->authorId);
	}
	/**
	 * mutator/setter method for author id
	 *
	 * @param Uuid|string $newAuthorId new value of author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not a uuid or string

	 */
	public function setAuthorId($newAuthorId) {
		//verify the author id is valid
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the tweet id
		$this->authorId = $uuid;
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
			throw(new \InvalidArgumentException("user activation is not valid"));
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
		return($this->authorAvatarUrl);
	}
	/**
	 * mutator/setter method for author avatar URL
	 *
	 * @param string $newAuthorAvatarUrl new value of author avatar url
	 * @throws \UnexpectedValueException if $newAuthorAvatarUrl is not a url
	 * @throws \RangeException if url is longer than 255 characters
	 */
	public function setAuthorAvatarUrl($newAuthorAvatarUrl) {
		//checks if newAuthorAvatarUrl is a url
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_VALIDATE_URL);
		if($newAuthorAvatarUrl === false) {
			throw(new \UnexpectedValueException("Avatar Url is not a url"));
		}
		//checks if $newAuthorAvatarUrl is less than 255 length
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("url needs to be less than 255 characters in length"));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
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
	 * @throws \InvalidArgumentException if $newAuthorEmail is not valid email or insecure
	 * @throws \RangeException if $newAuthorEmail is more than 128 char
	 * @throws \TypeError if $newAuthorEmail is not a string
	 */
	public function setAuthorEmail(string $newAuthorEmail): void {
		//verify the email is secure and string
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("profile email is empty or insecure"));
		}
		//verify is email is not longer than 128 chars
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("Email is too long"));
		}
		$this->authorEmail = $newAuthorEmail;
	}
	/**
	 * accesor/getter method for author hash
	 *
	 * @return string value of author hash
	 */
	public function getAuthorHash() {
		return($this->authorHash);
	}
	/**
	 * mutator/setter method for author hash
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException is hash is insecure
	 * @throws \RangeException if author hash is not 97 chars
	 * @throws \TypeError if author has is not a string
	 */
	public function setAuthorHash(string $newAuthorHash): void {
		//check if has is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("hash is empty or insecure"));
		}
		//make sure hash is correct type of hash
		/*$authorHashInfo = password_get_info($newAuthorHash);
		if($authorHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("author hash is not a valid hash"));
		}*/
		//check if has is exactly 97 characters
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("hash must be 97 characters in length"));
		}
		$this->authorHash = $newAuthorHash;
	}
	/**
	 * accessor/getter method for author username
	 *
	 * @return string value of author username
	 */
	public function getAuthorUsername() {
		return($this->authorUsername);
	}
	/**
	 * mutator/setter method for author Username
	 *
	 * @param string $newAuthorUsername
	 * @throws \InvalidArgumentException if username is not a string or insecure
	 * @throws \RangeException if username is longer than 32
	 * @throws \TypeError if username is not a string
	 */
	public function setAuthorUsername(string $newAuthorUsername): void {
		//verify username is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}
		//verify username is not too long
		if(strlen($newAuthorUsername) > 32) {
			throw(new \RangeException("username is too long"));
		}
		$this->authorUsername = $newAuthorUsername;
	}
	/**
	 * constructor for this author class
	 *
	 * @param int $newAuthorId
	 * @param string $newAuthorActivationToken
	 * @param string $newAuthorAvatarUrl
	 * @param string $newAuthorEmail
	 * @param string $newAuthorHash
	 * @param string $newAuthorUsername
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 */
	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}
			//determing what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 */
	public function jsonSerialize() : array {
		//collects all state variables
		$fields = get_object_vars($this);
		//turns Uuid's into strings
		$fields["authorId"] = $this->authorId->toString();
	}

	/**
	 * inserts author into MySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when myswl related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) : void {
		//create query template
		$query = "INSERT INTO author(
                   authorId, 
                   authorActivationToken, 
                   authorAvatarUrl, 
                   authorEmail,
                   authorHash,
                   authorUsername)
               VALUES(
                  :authorId, 
                  :authorActivationToken, 
                  :authorAvatarUrl, 
                  :authorEmail, 
                  :authorHash, 
                  :authorUsername)";
		$statement = $pdo->prepare($query);
		//create relationship between php state variables and PDO/MySQL variables
		$parameters = [
			"authorId" => $this->authorId->getBytes(),
			"authorActivationToken" => $this->authorActivationToken,
			"authorAvatarUrl" => $this->authorAvatarUrl,
			"authorEmail" => $this->authorEmail,
			"authorHash" => $this->authorHash,
			"authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}
	/**
	 * deletes author from MySQL database
	 * 
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when myswl related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
}