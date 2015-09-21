<?php
require('./vendor/autoload.php');

use repocount\actions\CountCompanyEmployeesRepositories;
use repocount\actions\CountTeamMembersRepositories;
use repocount\application\query\SqlEmployeeQueryService;
use repocount\application\query\SqlTeamMemberQueryService;

$bdd = new PDO('mysql:host=database;dbname=repocount', 'repocount', 'password');

$employeeQueryService = new SqlEmployeeQueryService($bdd);
$teamMemberQueryService = new SqlTeamMemberQueryService($bdd);
$countCompanyEmployeesRepositories = new CountCompanyEmployeesRepositories($employeeQueryService);
$countTeamMembersRepositories = new CountTeamMembersRepositories($teamMemberQueryService);

?>

<html>
<title>
	<title>Step 1</title>

	<body>

		<div>
			<h1>Companies</h1>
			<ul>
				<?php
				foreach ($bdd->query("SELECT * FROM company") as $row)
				{
					?>
					<li><?= $row['name'] ?></li>
					<?php
				}
				?>
			</ul>
		</div>

		<div>
			<h1>Step 1.1</h1>

			<p>
				<span>Repositories for Enalean : </span>
				<strong><?= $countCompanyEmployeesRepositories->countCompanyEmployeesRepositories('Enalean'); ?></strong>
			</p>

			<p>
				<span>Repositories for MyCompany : </span>
				<strong><?= $countCompanyEmployeesRepositories->countCompanyEmployeesRepositories('MyCompany'); ?></strong>
			</p>
		</div>
		<div>
			<h1>Step 1.2</h1>

			<p>
				<span>Repositories for TeamA : </span>
				<strong><?= $countTeamMembersRepositories->countTeamMembersRepositories('Enalean', 'TeamA'); ?></strong>
			</p>

			<p>
				<span>Repositories for TeamB : </span>
				<strong><?= $countTeamMembersRepositories->countTeamMembersRepositories('Enalean', 'TeamB'); ?></strong>
			</p>

			<p>
				<span>Repositories for MyTeam : </span>
				<strong><?= $countTeamMembersRepositories->countTeamMembersRepositories('MyCompany', 'MyTeam'); ?></strong>
			</p>
		</div>
	</body>
</html>