USE sae;

INSERT INTO utilisateur (nom, prenom, email, mot_de_pass) VALUES
('Dupont', 'Jean', 'jean.dupont@email.com', 'motdepasse1'),
('Martin', 'Sophie', 'sophie.martin@email.com', 'motdepasse2'),
('Durand', 'Pierre', 'pierre.durand@email.com', 'motdepasse3'),
('Lefevre', 'Marie', 'marie.lefevre@email.com', 'motdepasse4'),
('Moreau', 'Thomas', 'thomas.moreau@email.com', 'motdepasse5'),
('Girard', 'Lucie', 'lucie.girard@email.com', 'motdepasse6'),
('Petit', 'Antoine', 'antoine.petit@email.com', 'motdepasse7'),
('Sanchez', 'Camille', 'camille.sanchez@email.com', 'motdepasse8'),
('Rossi', 'Philippe', 'philippe.rossi@email.com', 'motdepasse9'),
('Garcia', 'Isabelle', 'isabelle.garcia@email.com', 'motdepasse10'),
('Muller', 'Michel', 'michel.muller@email.com', 'motdepasse11');

INSERT INTO enseignant (id_utilisateur) VALUES
(1), (2), (9);

INSERT INTO etudiant (id_utilisateur) VALUES
(3), (4), (5), (6), (7), (8),(10),(11);

INSERT INTO annee (id_annee, debut_annee, fin_annee) VALUES
(1, '2023-09-01', '2024-06-30'),
(2, '2024-09-01', '2025-06-30');

INSERT INTO semestre (id_semestre, type) VALUES
(1, 'S1'),
(2, 'S2');

INSERT INTO projet (nom, description, id_semestre, id_annee) VALUES
('Projet Web', 'Développement d un site web', 1, 1),
('Projet Mobile', 'Création d une application mobile', 2, 1),
('Projet IA', 'Intelligence Artificielle', 1, 2);

INSERT INTO responsable (nom,id_enseignant, id_projet) VALUES
('Responsable Projet Web',1, 1),
('Responsable Projet Mobile',2, 2);

INSERT INTO groupe (nom, image_titre, id_projet) VALUES
('Groupe A', 'image1.jpg', 1),
('Groupe B', 'image2.jpg', 1),
('Groupe C', 'image3.jpg', 2),
('Groupe D','image4.jpg',3);

INSERT INTO etudiant_groupe (id_groupe, id_etudiant) VALUES
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(3, 7),
(3, 8),
(4,8);

INSERT INTO ressource (titre, type, lien, date_creation, id_enseignant) VALUES
('Cours HTML', 'PDF', 'lien1.pdf', '2023-10-15', 1),
('Tutoriel Java', 'Vidéo', 'lien2.mp4', '2023-11-20', 2),
('Exercices Python', 'PDF', 'lien3.pdf', '2024-03-10', 1);

INSERT INTO rendu (nom, description, date_limite, id_projet) VALUES
('Rendu 1', 'Première version du site web', '2023-12-20', 1),
('Rendu 2', 'Version finale du site web', '2024-01-30', 1),
('Rendu App Mobile', 'Application fonctionnelle', '2024-05-15', 2);

INSERT INTO soutenance (date_soutenance, titre, id_projet, id_groupe) VALUES
('2024-02-15', 'Soutenance Projet Web - Groupe A', 1, 1),
('2024-02-18', 'Soutenance Projet Web - Groupe B', 1, 2),
('2024-06-05', 'Soutenance Projet Mobile - Groupe C', 2, 3);

INSERT INTO evaluation (type, coef, est_individuel) VALUES
('Contrôle Continu', 0.4, TRUE),
('Examen', 0.6, TRUE),
('Rapport', 0.5, FALSE),
('Soutenance', 0.5, FALSE);

INSERT INTO note (note, id_evaluation, id_etudiant, id_groupe) VALUES
(15.50, 1, 3, 1),
(12.00, 1, 4, 1),
(16.00, 3, NULL, 1),
(14.00, 1, 5, 2),
(13.50, 1, 6, 2),
(17.00, 3, NULL, 2),
(11.00, 1, 7, 3),
(18.00, 1, 8, 3),
(14.50, 3, NULL, 3),
(14.50, 2, 8, 4),
(15.50, 4, NULL, 4);

INSERT INTO champ (nom, type) VALUES
('Technologie', 'Texte'),
('Difficulté', 'Numérique');

INSERT INTO valeur_champ (valeur, id_champ) VALUES
('HTML/CSS', 1),
('Java', 1),
('Python', 1),
('3', 2),
('5', 2);