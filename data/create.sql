      CREATE TABLE RSS (
      id integer primary key autoincrement,
      titre varchar(255),
      url varchar(255),
      date integer 
      );

      CREATE TABLE nouvelle (
      id integer primary key autoincrement,
      date datetime,
      titre varchar(255),
      description varchar(1024),
      url varchar(255),
      image varchar(80),
      RSS_id integer
      );

      CREATE TABLE utilisateur (
      id integer primary key autoincrement,
      login varchar(80),
      mp varchar(8)
      );

      CREATE TABLE categorie(
      name varchar(30),
      decription varchar(1024),
      img varchar(40),
      primary key (name)
      );


      CREATE TABLE fluxcategorie(
	categorie varchar(30) REFERENCES categorie(name),
	RSS_id integer REFERENCES RSS(id),
	primary key (categorie,RSS_id)
      );

      CREATE TABLE abonnement (
      utilisateur_login varchar(80) REFERENCES utilisateur(login),
      RSS_id integer REFERENCES RSS(id),
      primary key (utilisateur_login,RSS_id)
      );

      CREATE TABLE interets (
      userID varchar(80) REFERENCES utilisateur(id),
      categorieID varchar(30) REFERENCES categorie(name),
      primary key (userID,categorieID)
      );

