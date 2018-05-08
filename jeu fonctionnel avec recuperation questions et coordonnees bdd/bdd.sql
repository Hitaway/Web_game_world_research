CREATE TABLE QUESTIONNAIRES
	(
		nom_questionnaire varchar(35) CONSTRAINT nn_nom_questionnaire NOT NULL,
		CONSTRAINT pk_questionnaire PRIMARY KEY(nom_questionnaire),
		);

CREATE TABLE QUESTIONS
	(
		intitule varchar(200) CONSTRAINT nn_nom_questionnaire NOT NULL,
		nom_questionnaire varchar(35),
		CONSTRAINT pk_questions PRIMARY KEY(nom_questionnaire,intitule),
		CONSTRAINT fk_nom_questionnaire FOREIGN KEY (nom_questionnaire) REFERENCES QUESTIONNAIRE
		);	