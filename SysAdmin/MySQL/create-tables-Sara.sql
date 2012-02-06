drop table if exists joomla_institute;

create table joomla_institute (
  id integer not null auto_increment,
  
  abbreviation varchar(10) not null,
  name varchar(250) not null,
  countrycode varchar(2),
  zipcode varchar(10),
  city varchar(40),
  street varchar(50),
  description varchar(500),
  url varchar(500),
  
  harvesterurl varchar(500),
  forharvest tinyint(1),
  
  primary key(id)
);

create index x_institute_abb on joomla_institute ( abbreviation );
create index x_institute_nam on joomla_institute ( name );
create index x_institute_cou on joomla_institute ( countrycode );

insert into joomla_institute ( abbreviation, name, url, countrycode, harvesterurl, forharvest ) 
values ( 'ITA',  'Institute of Technology Assessment', 'http://www.oeaw.ac.at/ita',  'AT', 'http://technology-assessment.info/run/json/sample', 1 );

insert into joomla_institute ( abbreviation, name, url, countrycode, harvesterurl, forharvest ) 
values ( 'ITAS', 'Institute for Technology Assessment and Systems Analysis', 'http://www.itas.kit.edu/english/', 'DE', 'http://technology-assessment.info/run/json/sample2', 1 );

select * from joomla_institute;







drop table if exists joomla_expert;

create table joomla_expert (
  id integer not null auto_increment,
  
  surname varchar(150) not null,
  firstnames varchar(100) not null,
  exptitle varchar(15),
  email varchar(256),
  phonenumber varchar(21),
  skypeid varchar(28),
  expertise varchar(500),
  emplurl varchar(500),
  tapublicationurl varchar(500),
  taprojecturl varchar(500),
  fkinstitute integer not null,
  
  primary key(id)
);

create index x_expert_sur on joomla_expert ( surname );
create index x_expert_fir on joomla_expert ( firstnames );
create index x_expert_fkins on joomla_expert ( fkinstitute );

insert into joomla_expert ( surname, firstnames, email, phonenumber, expertise, emplurl, fkinstitute ) 
values ( 'Gazso', 'Andre', 'agazso@oeaw.ac.at', '(+43-1-)51581-6578 ', 'nanotechnology,risik management,risk communication', 'http://www.oeaw.ac.at/ita/ebene3/e2-4a.htm#AG', 1 );

insert into joomla_expert ( surname, firstnames, email, phonenumber, expertise, emplurl, fkinstitute ) 
values ( 'Fleischer', 'Torsten', 'torsten fleischer@kit edu', '0721 608-24571', 'nanotechnologie,energy,transport', 'http://www.itas.kit.edu/mitarbeiter_fleischer_torsten.php', 2 );

select * from joomla_expert;













drop table if exists joomla_project;

create table joomla_project (
  id integer not null auto_increment,
  
  shorttitle varchar(40) not null,
  longtitle varchar(250) not null,
  shortdescription varchar(500),
  startdate date,
  enddate date,
  partnercountries varchar(150),
  scopecountries varchar(150),
  homepage varchar(250),
  focus varchar(500),
  fkcontactperson integer,
  
  primary key(id)
);

create index x_project_sht on joomla_project ( shorttitle );
create index x_project_lot on joomla_project ( longtitle );
create index x_project_std on joomla_project ( startdate );
create index x_project_end on joomla_project ( enddate );
create index x_project_fkcon on joomla_project ( fkcontactperson );

insert into joomla_project ( shorttitle, startdate, enddate, partnercountries, homepage, fkcontactperson ) 
values ( 'NanoTrust', '2007-10-01', '2010-09-01', 'EU', 'http://nanotrust.ac.at', 1 );

insert into joomla_project ( shorttitle, startdate, partnercountries, homepage, fkcontactperson ) 
values ( 'Risiko-Governance', '2010-05-05', 'EU', 'http://www.itas.kit.edu/projekte_flei10_parna.php', 2 );

select * from joomla_project;











drop table if exists joomla_publication;

create table joomla_publication (
  id integer not null auto_increment,
  
  quotation varchar(500) not null,
  shortdescription varchar(500) not null,
  publdate date,
  publtype varchar(20),
  fkinstitute integer,
  
  primary key(id)
);

create index x_publication_quo on joomla_publication ( quotation );
create index x_publication_pud on joomla_publication ( publdate );
create index x_publication_put on joomla_publication ( publtype );
create index x_publication_fkins on joomla_publication ( fkinstitute );

insert into joomla_publication ( quotation, publdate, publtype, fkinstitute ) 
values ( 'Fleischer, T., Nano-Produktregister als ein Beitrag zur Risiko-Governance von Nanomaterialien? Vortrag auf dem 5. Internationalen Nano-Behördendialog. Berlin, 03.-04.05.2011', '2011-04-02', 'presentation', 2 );

insert into joomla_publication ( quotation, publdate, publtype, fkinstitute ) 
values ( 'Gazsó, A.; Hauser, Chr.; Kaiser, M. (2012) Regulating Nanotechnologies By Dialogue. The European Journal of Risk Regulation (EJRR) (2/2012)', '2012-01-25', 'article', 1 );

insert into joomla_publication ( quotation, publdate, publtype, fkinstitute ) 
values ( 'Gazsó, A.; Greßler, S.; Schiemer, F. (Hrsg.) (2007) nano - Chancen und Risiken aktueller Technologien.; Wien: Springer (246 Seiten).www.springer.com/materials/nanotechnology/book/978-3-211-48644-3', '2007-06-26', 'book', 1 );

select * from joomla_publication;











drop table if exists joomla_harvest;

create table joomla_harvest (
  id integer not null auto_increment,
  
  starttime datetime not null,
  endtime datetime,
  fkinstitute integer not null,
  url varchar(500) not null,
  errormsg varchar(500),
  json mediumblob,
  message mediumblob,
    
  primary key(id)
);

create index x_harvest_fkins on joomla_harvest ( fkinstitute );
create index x_harvest_stt on joomla_harvest ( starttime );
create index x_harvest_url on joomla_harvest ( url );
create index x_harvest_ent on joomla_harvest ( endtime );











drop table if exists joomla_harvesterlog;

create table joomla_harvesterlog (
  id integer not null auto_increment,
  
  point datetime not null,
  message varchar(500),
  exception varchar(500),
  fkinstitute integer,
  harvestid integer,
    
  primary key(id)
);

create index x_harvest_poi on joomla_harvesterlog ( point );
create index x_harvest_fkins on joomla_harvesterlog ( fkinstitute );
create index x_harvest_hai on joomla_harvesterlog ( harvestid );

