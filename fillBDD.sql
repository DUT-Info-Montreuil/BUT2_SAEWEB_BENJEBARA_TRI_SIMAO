USE sae;

-- Insertion des données dans la table Utilisateur
INSERT INTO utilisateur (nom, prenom, email, mot_de_pass) VALUES
('Dupont', 'Jean', 'prof', 'aze'),
('Martin', 'Sophie', 'tom', 'aze'),
('Doe', 'John', 'prof2', 'aze'),
('Smith', 'Jane', 'prof3', 'aze'),
('Dupont', 'Jean', 'jean.dupont@example.com', 'password789'),
('Martin', 'Sophie', 'sophie.martin@example.com', 'password101'),
('Lefevre', 'Pierre', 'pierre.lefevre@example.com', 'password112'),
('Moreau', 'Emilie', 'emilie.moreau@example.com', 'password1234'),
('Laurent', 'Thomas', 'thomas.laurent@example.com', 'password5678'),
('Bernard', 'Laura', 'laura.bernard@example.com', 'password7890');


-- Insertion des données dans la table Enseignant
INSERT INTO enseignant (id_utilisateur) VALUES
(1), (3), (4), (5);

-- Insertion des données dans la table Semestre
INSERT INTO semestre (id_semestre, type) VALUES
(1, 'S1'), (2, 'S2'), (3, 'S3'), (4, 'S4'), (5, 'S5'), (6, 'S6');


-- Insertion des données dans la table Etudiant
INSERT INTO etudiant (id_utilisateur, semestre_utilisateur) VALUES
(2, 1), (6, 2), (7, 3), (8, 3), (9, 4), (10, 4);


-- Insertion des données dans la table Annee
INSERT INTO annee (id_annee, debut_annee, fin_annee) VALUES
(2022, '2022-09-01', '2023-06-30'),
(2023, '2023-09-01', '2024-06-30');

-- Insertion des données dans la table Projet
INSERT INTO projet (nom, description, id_semestre, id_annee) VALUES
('Projet Web', 'Développement une application web', 1, 2023),
('Projet Mobile', 'Développement une application mobile', 2, 2023),
('Projet Jeu Vidéo', 'Développement jeu vidéo', 3, 2023),
('Projet IA', 'Développement intelligence artificielle', 4, 2023);

-- Insertion des données dans la table Responsable
INSERT INTO responsable (id_enseignant, id_projet) VALUES
(1, 1),
(1, 2),
(2, 2);

-- Insertion des données dans la table Groupe
INSERT INTO groupe (nom, image_titre, id_projet) VALUES
('Groupe A', 'image_groupe_a.jpg', 1),
('Groupe B', 'image_groupe_b.jpg', 1),
('Groupe C', 'image_groupe_c.jpg', 2),
('Groupe D', 'image_groupe_d.jpg', 2);


-- Insertion des données dans la table etudiant_groupe
INSERT INTO etudiant_groupe (id_groupe, id_etudiant) VALUES
(1, 2),
(3, 2),
(4, 3),
(4, 4);

-- Insertion des données dans la table Ressource
INSERT INTO ressource (titre, type, lien, date_creation, id_enseignant) VALUES
('Cours HTML', 'Cours', 'http://example.com/html', '2023-09-01', 1),
('Cours CSS', 'Cours', 'http://example.com/css', '2023-09-08', 1),
('Cours JavaScript', 'Cours', 'http://example.com/javascript', '2023-09-15', 2);


-- Insertion des données dans la table Rendu
INSERT INTO rendu (nom, description, date_limite, id_projet) VALUES
('Rendu 1', 'Premier rendu du projet', '2023-10-01', 1),
('Rendu 2', 'Deuxième rendu du projet', '2023-11-01', 1),
('Rendu 3', 'Troisième rendu du projet', '2023-12-01', 2);


-- Insertion des données dans la table Soutenance
INSERT INTO soutenance (date_soutenance, titre, id_projet, id_groupe) VALUES
('2024-01-01', 'Soutenance Projet Web', 1, 1),
('2024-01-08', 'Soutenance Projet Mobile', 2, 3);


-- Insertion des données dans la table Evaluation
INSERT INTO evaluation (type, coef, est_individuel) VALUES
('Examen', 0.5, TRUE),
('Projet', 0.5, FALSE);

-- Insertion des données dans la table Note
INSERT INTO note (note, id_evaluation, id_etudiant, id_groupe) VALUES
(15.5, 1, 3, 1),
(12.0, 1, 3, 1),
(17.5, 2, 3, 1),
(14.0, 1, 3, 2);

-- Insertion des données dans la table Champ
INSERT INTO champ (nom, type) VALUES
('Nom du groupe', 'TEXT'),
('Nombre de membres', 'NUMBER');


-- Insertion des données dans la table Valeur_champ
INSERT INTO valeur_champ (valeur, id_champ) VALUES
('Groupe A', 1),
('4', 2);
