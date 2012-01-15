drop table if exists joomla_institute;

create table joomla_institute (
  id integer not null auto_increment,
  
  abbreviation varchar(10) not null,
  name varchar(51) not null,
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

insert into joomla_institute ( abbreviation, name, countrycode, harvesterurl, forharvest ) values ( 'TAPortal',  'JSON-Sample',  'AT', 'http://technology-assessment.info/run/json/sample', 1 );
insert into joomla_institute ( abbreviation, name, countrycode, harvesterurl, forharvest ) values ( 'TAPortal2', 'JSON-Sample2', 'AT', 'http://technology-assessment.info/run/json/sample2', 1 );
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

insert into joomla_expert ( surname, firstnames, fkinstitute ) values ( 'Meier', 'Anton', 1 );
select * from joomla_expert;













drop table if exists joomla_project;

create table joomla_project (
  id integer not null auto_increment,
  
  shorttitle varchar(40) not null,
  longtitle varchar(250) not null,
  shortdescription varchar(500),
  startdate date,
  enddate time,
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

insert into joomla_project ( shorttitle, longtitle, startdate, partnercountries, fkcontactperson ) values ( 'Proj1', 'Project1', '2000-07-01', 'EU', 1 );
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

insert into joomla_publication ( quotation, shortdescription, publdate, publtype, fkinstitute ) values ( 'Publ1', 'publ publ publ', '2000-07-01', 'article', 1 );
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

