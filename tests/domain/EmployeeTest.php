<?php

use repocount\domain\Employee;

class EmployeeTest extends PHPUnit_Framework_TestCase
{
	function test_username_should_return_employee_username()
	{
		$employee = Employee::builder()->withUsername('jgiovaresco')->build();
		expect($employee->username())->to->be->equal('jgiovaresco');
	}

	function test_repositories_should_return_employee_repositories()
	{
		$employee = Employee::builder()->withUsername('jgiovaresco')->withRepository('repo1')->withRepository('repo2')->build();
		expect($employee->repositories())->to->be->an('array')->and->has->length(2);
		expect($employee->repositories())->to->include('repo1')->and->to->include('repo2');
	}
}

?>