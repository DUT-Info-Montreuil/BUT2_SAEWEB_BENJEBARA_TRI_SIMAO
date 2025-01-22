DROP SCHEMA IF EXISTS sae;
CREATE SCHEMA sae;
USE sae;

-- Table Utilisateur
DROP TABLE IF EXISTS utilisateur;
CREATE TABLE utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_pass VARCHAR(255) NOT NULL 
);

-- Table Enseignant
DROP TABLE IF EXISTS enseignant;
CREATE TABLE enseignant (
    id_enseignant INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);
-- Table Semestre
DROP TABLE IF EXISTS semestre;
CREATE TABLE semestre (
    id_semestre INT PRIMARY KEY,
    type VARCHAR(50)
);
-- Table Etudiant
DROP TABLE IF EXISTS etudiant;
CREATE TABLE etudiant (
    id_etudiant INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    semestre_utilisateur INT,
    FOREIGN KEY (semestre_utilisateur) REFERENCES semestre(id_semestre),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

-- Table Annee
DROP TABLE IF EXISTS annee;
CREATE TABLE annee (
    id_annee INT PRIMARY KEY,
    debut_annee DATE,
    fin_annee DATE
);



-- Table Projet
DROP TABLE IF EXISTS projet;
CREATE TABLE projet (
    id_projet INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    description TEXT,
    id_semestre INT,
    id_annee INT,
    FOREIGN KEY (id_semestre) REFERENCES semestre(id_semestre),
    FOREIGN KEY (id_annee) REFERENCES annee(id_annee)
);

-- Table Responsable
DROP TABLE IF EXISTS responsable;
CREATE TABLE responsable (
    id_responsable INT AUTO_INCREMENT PRIMARY KEY,
    id_enseignant INT,
    id_projet INT,
    FOREIGN KEY (id_enseignant) REFERENCES enseignant(id_enseignant),
    FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
);

-- Table GROUPE
DROP TABLE IF EXISTS groupe;
CREATE TABLE groupe (
    id_groupe INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    image_titre VARCHAR(255),
    id_projet INT,
    FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
);

-- Table etudiant_groupe
DROP TABLE IF EXISTS etudiant_groupe;
CREATE TABLE etudiant_groupe (
    id_groupe INT,
    id_etudiant INT,
    PRIMARY KEY (id_etudiant, id_groupe),
    FOREIGN KEY (id_etudiant) REFERENCES etudiant(id_etudiant),
    FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe)
);

-- Table Ressource
DROP TABLE IF EXISTS ressource;
CREATE TABLE ressource (
    id_ressource INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100),
    type VARCHAR(50),
    lien VARCHAR(255),
    date_creation DATE,
    id_enseignant INT,
    fichier VARCHAR(255),
    id_projet INT,
    FOREIGN KEY (id_enseignant) REFERENCES enseignant(id_enseignant)
);

-- Table Rendu
DROP TABLE IF EXISTS rendu;
CREATE TABLE rendu (
    id_rendu INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    description TEXT,
    date_limite DATE,
    id_projet INT,
    FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
);

-- Table Soutenance
DROP TABLE IF EXISTS soutenance;
CREATE TABLE soutenance (
    id_soutenance INT AUTO_INCREMENT PRIMARY KEY,
    date_soutenance DATE,
    titre VARCHAR(255),
    id_projet INT,
    id_groupe INT,
    FOREIGN KEY (id_projet) REFERENCES projet(id_projet),
    FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe)
);

-- Table Evaluation
DROP TABLE IF EXISTS evaluation;
CREATE TABLE evaluation (
    id_evaluation INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50),
    coef DECIMAL(5, 2),
    est_individuel BOOLEAN
);

-- Table Note
DROP TABLE IF EXISTS note;
CREATE TABLE note (
    id_note INT AUTO_INCREMENT PRIMARY KEY,
    note DECIMAL(4, 2),
    id_evaluation INT,
    id_etudiant INT,
    id_groupe INT,
    FOREIGN KEY (id_evaluation) REFERENCES evaluation(id_evaluation),
    FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe),
    FOREIGN KEY (id_etudiant) REFERENCES etudiant(id_etudiant)
);

-- Table Champ
DROP TABLE IF EXISTS champ;
CREATE TABLE champ (
    id_champ INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    type VARCHAR(50)
);

-- Table Valeur_champ
DROP TABLE IF EXISTS valeur_champ;
CREATE TABLE valeur_champ (
    id_valeurChamp INT AUTO_INCREMENT PRIMARY KEY,
    valeur VARCHAR(255),
    id_champ INT,
    FOREIGN KEY (id_champ) REFERENCES champ(id_champ)
);

DROP TABLE IF EXISTS demande_groupe;
CREATE TABLE demande_groupe (
    id_demande INT PRIMARY KEY AUTO_INCREMENT,
    id_projet INT NOT NULL,
    id_etudiant INT NOT NULL,
    membres_demandes TEXT NOT NULL,
    date_demande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_projet) REFERENCES projet(id_projet),
    FOREIGN KEY (id_etudiant) REFERENCES etudiant(id_etudiant)
);