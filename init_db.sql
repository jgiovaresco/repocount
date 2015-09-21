DROP DATABASE IF EXISTS repocount;
CREATE DATABASE repocount;
USE repocount;

CREATE TABLE `company` (
  `id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  UNIQUE KEY `k_name` (`name`),
  PRIMARY KEY (`id`)
);
CREATE TABLE team
(
  `id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company_id` varchar(36) NOT NULL,
  UNIQUE KEY `k_name` (`name`),
  CONSTRAINT `fk_team_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  PRIMARY KEY (`id`)
);
CREATE TABLE `employee`
(
  `id` varchar(36) NOT NULL,
  `username` varchar(100) NOT NULL,
  `company_id` varchar(36) NOT NULL,
  `team_id` varchar(36) NOT NULL,
  UNIQUE KEY `k_username` (`username`),
  CONSTRAINT `fk_employee_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `fk_employee_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  PRIMARY KEY (`id`)
);
CREATE TABLE repository
(
  `id` varchar(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `owner_id` varchar(36) NOT NULL,
  UNIQUE KEY `k_owner_name` (`name`, `owner_id`),
  CONSTRAINT `fk_repository_employee` FOREIGN KEY (`owner_id`) REFERENCES `employee` (`id`),
  PRIMARY KEY (`id`)
);

INSERT INTO company (id, name) VALUES ('1', 'Enalean');
INSERT INTO company (id, name) VALUES ('2', 'MyCompany');

INSERT INTO team (id, name, company_id) VALUES ('1', 'TeamA', '1');
INSERT INTO team (id, name, company_id) VALUES ('2', 'TeamB', '1');
INSERT INTO team (id, name, company_id) VALUES ('3', 'MyTeam', '2');

INSERT INTO employee (id, username, company_id, team_id) VALUES ('1', 'nteray', '1', '1');
INSERT INTO employee (id, username, company_id, team_id) VALUES ('2', 'yrosset', '1', '1');
INSERT INTO employee (id, username, company_id, team_id) VALUES ('3', 'sandrae', '1', '2');
INSERT INTO employee (id, username, company_id, team_id) VALUES ('4', 'jgiovaresco', '2', '3');

-- nterray
INSERT INTO repository (id, name, owner_id) VALUES ('01', 'repo1', '1');
INSERT INTO repository (id, name, owner_id) VALUES ('02', 'repo2', '1');
INSERT INTO repository (id, name, owner_id) VALUES ('03', 'repo3', '1');
-- yrosset
INSERT INTO repository (id, name, owner_id) VALUES ('04', 'repo1', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('05', 'repo2', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('06', 'repo3', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('07', 'repo4', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('08', 'repo5', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('09', 'repo6', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('10', 'repo7', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('11', 'repo8', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('12', 'repo9', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('13', 'repo10', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('14', 'repo11', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('15', 'repo12', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('16', 'repo13', '2');
INSERT INTO repository (id, name, owner_id) VALUES ('17', 'repo14', '2');
-- sandrae
INSERT INTO repository (id, name, owner_id) VALUES ('18', 'repo1', '3');
INSERT INTO repository (id, name, owner_id) VALUES ('19', 'repo2', '3');
INSERT INTO repository (id, name, owner_id) VALUES ('20', 'repo3', '3');
INSERT INTO repository (id, name, owner_id) VALUES ('21', 'repo4', '3');
INSERT INTO repository (id, name, owner_id) VALUES ('22', 'repo5', '3');
-- jgiovaresco
INSERT INTO repository (id, name, owner_id) VALUES ('12842737', '.vim', '4');

COMMIT;


