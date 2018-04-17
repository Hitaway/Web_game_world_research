DROP TABLE UTILISATEURS;
DROP TABLE HISTORIQUE;
DROP TABLE QUESTIONNAIRES;
DROP TABLE QUESTIONS;
DROP TABLE CLASSEMENT;

CREATE TABLE UTILISATEURS(
	pseudo	 			VARCHAR(35),
	prenom	 			VARCHAR(35),
	nom		 			VARCHAR(35),
	email	 			VARCHAR(35),
	mdp	   			 	VARCHAR(35),
	date_inscription	DATE,
	CONSTRAINT pk_utilisateur PRIMARY KEY(pseudo),
	CONSTRAINT nn_utilisateur_prenom CHECK(prenom IS NOT NULL),
	CONSTRAINT nn_utilisateur_email CHECK(email IS NOT NULL),
	CONSTRAINT nn_utilisateur_nom CHECK(nom IS NOT NULL),
	CONSTRAINT nn_utilisateur_mdp CHECK(mdp IS NOT NULL),
	CONSTRAINT nn_utilisateur_date_inscription CHECK(date_inscription IS NOT NULL)
);

CREATE TABLE HISTORIQUE(
	numero				NUMBER,
	pseudo 				VARCHAR(35),
	score				NUMBER,
	nom_questionnaire 	VARCHAR(35),
	CONSTRAINT pk_historique PRIMARY KEY(numero),
	CONSTRAINT fk_historique_pseudo_utilisateur FOREIGN KEY(pseudo) REFERENCES UTILISATEURS,
	CONSTRAINT nn_historique_pseudo CHECK(pseudo IS NOT NULL),
	CONSTRAINT nn_historique_score CHECK(score IS NOT NULL),
	CONSTRAINT nn_historique_nom_questionnaire CHECK(nom_questionnaire IS NOT NULL)
);

CREATE TABLE CLASSEMENT(
	numero		NUMBER,
	pseudo 		VARCHAR(35),
	score 		VARCHAR(35),
	CONSTRAINT pk_classement PRIMARY KEY(numero),
	CONSTRAINT fk_classement_num_psd_sco_historique FOREIGN KEY(numero, pseudo, score) REFERENCES HISTORIQUE,
	CONSTRAINT nn_classement_pseudo CHECK(pseudo IS NOT NULL),
	CONSTRAINT nn_classement_score CHECK(score IS NOT NULL)
);

CREATE TABLE QUESTIONNAIRES(
	nom_questionnaire  	VARCHAR(35),
	CONSTRAINT pk_questionnaire PRIMARY KEY(nom_questionnaire)
);

CREATE TABLE QUESTIONS(
	intitule 			VARCHAR(200),
	nom_questionnaire	VARCHAR(35),
	CONSTRAINT pk_questions PRIMARY KEY(intitule, nom_questionnaire),
	CONSTRAINT fk_questions_nom_questionnaire_questionnaires FOREIGN KEY(nom_questionnaire) REFERENCES QUESTIONNAIRE,
	CONSTRAINT nn_questions_nom_questionnaire CHECK(nom_questionnaire IS NOT NULL)
);