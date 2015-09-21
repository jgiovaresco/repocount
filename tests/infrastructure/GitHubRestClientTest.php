<?php
use repocount\domain\Employee;
use repocount\infrastructure\GitHubRestClient;

class GitHubRestClientTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var GitHubRestClient
	 */
	private $gitHubRestClient;
	private $mockRequest;

	protected function setUp()
	{
		parent::setUp();
		$this->mockRequest = $this
			->getMockBuilder('Httpful\Request')
			->disableOriginalConstructor()
			->disableOriginalClone()
			->setMethods(array('uri', 'send', 'expectsJson'))
			->getMock();

		$this->gitHubRestClient = new GitHubRestClient($this->mockRequest);
	}

	public function testListUserRepositories()
	{
		$this->mockRequest->expects($this->once())
			->method('expectsJson')
			->willReturn($this->mockRequest);
		$this->mockRequest->expects($this->once())
			->method('uri')
			->with($this->equalTo('https://api.github.com/users/jgiovaresco/repos'))
			->willReturn($this->mockRequest);
		$this->mockRequest->expects($this->once())
			->method('send')
			->willReturn(
				new \Httpful\Response(
					'[{
						"id": 123,
						"name": ".vim"
					},{
						"id": 124,
						"name": "repocount"
					}]',
					"HTTP/1.1 200 OK
					Content-Type: application/json
					Connection: keep-alive
					Transfer-Encoding: chunked\r\n",
					$req = \Httpful\Request::init()->sendsAndExpects(\Httpful\Mime::JSON))
			);

		$repositories = $this->gitHubRestClient->listUserRepositories(Employee::builder()->withId('123')->withUsername('jgiovaresco')->build());

		expect($repositories)->to->have->length(2);
		expect($repositories[0]->name())->to->equal('.vim');
		expect($repositories[1]->name())->to->equal('repocount');
	}
}

?>