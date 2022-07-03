create table department(id_department int(5) primary key, nom_department varchar(50));
create table professeur(Id_prof int(5) primary key, nom varchar(30), prenom varchar(30), cin varchar(30), adresse varchar(40), telephone varchar(15), email varchar(50), date_recrutement DATE, id_department int(5) references department(id_department));
create table cours(id_cours int(5) primary key, intitule varchar(50), id_prof int(5) references professeur(Id_prof));
create table Utilisateur(id_utilisateur int(5) primary key, nom varchar(30), prenom varchar(30), date_naissance date, mdp varchar(50));
create table prof_c(id int(5), id_prof int(5) references professeur(Id_Prof), id_cours int(5) references cours(id_cours), primary key(id, id_prof, id_cours));