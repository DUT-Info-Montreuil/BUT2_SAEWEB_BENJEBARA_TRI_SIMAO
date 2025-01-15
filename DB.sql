DROP SCHEMA IF EXISTS sae;
CREATE SCHEMA sae;
USE sae;

-- Table Utilisateur
DROP TABLE IF EXISTS utilisateur;
CREATE TABLE Utilisateur (
    id_utilisateur SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_pass VARCHAR(255) NOT NULL 
);

-- Table Enseignant
DROP TABLE IF EXISTS enseignant;
CREATE TABLE Enseignant (
    id_enseignant SERIAL PRIMARY KEY,
    FOREIGN KEY (id_enseignant) REFERENCES Utilisateur(id_utilisateur)
);

-- Table Etudiant
DROP TABLE IF EXISTS etudiant;
CREATE TABLE etudiant (
    id_etudiant SERIAL PRIMARY KEY,
    FOREIGN KEY (id_etudiant) REFERENCES utilisateur(id_utilisateur)
);

DROP TABLE IF EXISTS annee;
CREATE TABLE annee (
    id_annee INT PRIMARY KEY,
    debut_annee DATE,
    fin_annee DATE
);

DROP TABLE IF EXISTS semestre;
CREATE TABLE semestre (
    id_semestre INT PRIMARY KEY,
    type VARCHAR(50)
);

--
DROP TABLE IF EXISTS projet;
CREATE TABLE projet (
    id_projet INT PRIMARY KEY,
    nom VARCHAR(100),
    description TEXT,
	id_semestre INT,
	id_annee INT,
	FOREIGN KEY (id_semestre) REFERENCES semestre(id_semestre),
	FOREIGN KEY (id_annee) REFERENCES annee(id_annee)
);

DROP TABLE IF EXISTS responsable;
CREATE TABLE responsable (
    id_responsable SERIAL PRIMARY KEY,
    nom VARCHAR(100),
	id_projet INT,
	FOREIGN KEY (id_responsable) REFERENCES enseignant(id_enseignant),
	FOREIGN KEY (id_projet) REFERENCES projet(id_projet)

);

-- Table GROUPE
DROP TABLE IF EXISTS GROUPE;
CREATE TABLE groupe (
    id_groupe INT PRIMARY KEY,
    nom VARCHAR(100),
    image_titre VARCHAR(255),
	id_projet INT,
	FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
);

DROP TABLE IF EXISTS etudiant_groupe;
CREATE TABLE etudiant_groupe (
	id_groupe INT,
    id_etudiant SERIAL,
    PRIMARY KEY (id_etudiant, id_groupe),
    FOREIGN KEY (id_etudiant) REFERENCES etudiant(id_etudiant),
    FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe)
);

DROP TABLE IF EXISTS ressource;
CREATE TABLE ressource (
    id_ressource INT PRIMARY KEY,
    titre VARCHAR(100),
    type VARCHAR(50),
    lien VARCHAR(255),
    date_creation DATE,
	creator SERIAL,
	FOREIGN KEY (creator) REFERENCES enseignant(id_enseignant)
);

DROP TABLE IF EXISTS rendu;
CREATE TABLE rendu (
    id_rendu INT PRIMARY KEY,
    nom VARCHAR(100),
    description TEXT,
    date_limite DATE,
    id_projet INT,
    FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
);

DROP TABLE IF EXISTS soutenance;
CREATE TABLE soutenance (
    id_soutenance INT PRIMARY KEY,
    date_soutenance DATE,
    titre VARCHAR(255),
    id_projet INT,
	id_groupe INT,
    FOREIGN KEY (id_projet) REFERENCES projet(id_projet),
	FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe)
);

DROP TABLE IF EXISTS evaluation;
CREATE TABLE evaluation (
    id_evaluation INT PRIMARY KEY,
    type VARCHAR(50),
    coef DECIMAL(5, 2),
    est_individuel BOOLEAN
);

DROP TABLE IF EXISTS note;
CREATE TABLE note (
    id_note INT PRIMARY KEY,
    note DECIMAL(2, 2),
    id_evaluation INT,
    id_etudiant SERIAL,
	id_groupe INT,
    FOREIGN KEY (id_evaluation) REFERENCES evaluation(id_evaluation),
	FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe),
    FOREIGN KEY (id_etudiant) REFERENCES etudiant(id_etudiant)
);

DROP TABLE IF EXISTS champ;
CREATE TABLE champ (
    id_champ INT PRIMARY KEY,
    nom VARCHAR(100),
    type VARCHAR(50)
);

DROP TABLE IF EXISTS valeur_champ;
CREATE TABLE valeur_champ (
    id_valeurChamp INT PRIMARY KEY,
    valeur VARCHAR(255),
    id_champ INT,
    FOREIGN KEY (id_champ) REFERENCES champ(id_champ)
);

























































































