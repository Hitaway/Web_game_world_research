/*mDROP TABLE UTILISATEURS CASCADE CONSTRAINTS;
DROP TABLE HISTORIQUE CASCADE CONSTRAINTS;
DROP TABLE QUESTIONNAIRES CASCADE CONSTRAINTS;
DROP TABLE QUESTIONS CASCADE CONSTRAINTS;
DROP TABLE CLASSEMENT CASCADE CONSTRAINTS;*/

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
	CONSTRAINT nn_utilisateur_date_inscpt CHECK(date_inscription IS NOT NULL)
);

CREATE TABLE HISTORIQUE(
	id					NUMBER,
	pseudo 				VARCHAR(35),
	score				NUMBER,
	nom_questionnaire 	VARCHAR(35),
	date_partie			DATE,
	CONSTRAINT pk_historique PRIMARY KEY(id),
	CONSTRAINT fk_historique_pseudo_util FOREIGN KEY(pseudo) REFERENCES UTILISATEURS,
	CONSTRAINT nn_historique_pseudo CHECK(pseudo IS NOT NULL),
	CONSTRAINT nn_historique_score CHECK(score IS NOT NULL),
	CONSTRAINT nn_historique_nom_quest CHECK(nom_questionnaire IS NOT NULL),
	CONSTRAINT nn_historique_date_partie CHECK(date_partie IS NOT NULL)
);

CREATE TABLE CLASSEMENT(
	id					NUMBER,
	score 				NUMBER,
	CONSTRAINT pk_classement PRIMARY KEY(id, score),
	CONSTRAINT fk_classement_num_psd_sco_historique FOREIGN KEY(id, score) REFERENCES HISTORIQUE
);

CREATE TABLE QUESTIONNAIRES(
	nom_questionnaire  	VARCHAR(100),
	CONSTRAINT pk_questionnaire PRIMARY KEY(nom_questionnaire)
);

CREATE TABLE QUESTIONS(
	intitule 			VARCHAR(300),
	nom_questionnaire	VARCHAR(100),
	CONSTRAINT pk_questions PRIMARY KEY(intitule, nom_questionnaire),
	CONSTRAINT fk_questions_nom_quest_quest FOREIGN KEY(nom_questionnaire) REFERENCES QUESTIONNAIRES,
	CONSTRAINT nn_questions_nom_quest CHECK(nom_questionnaire IS NOT NULL)
);


ALTER TABLE `UTILISATEURS` ADD CONSTRAINT `test` FOREIGN KEY (`pseudo`) REFERENCES `UTILISATEURS`(`pseudo`) ON DELETE RESTRICT ON UPDATE RESTRICT;