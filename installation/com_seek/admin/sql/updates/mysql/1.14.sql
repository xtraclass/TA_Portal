drop table if exists #__institute;

create table #__institute (
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

create index x_institute_abb on #__institute ( abbreviation );
create index x_institute_nam on #__institute ( name );
create index x_institute_cou on #__institute ( countrycode );

insert into #__institute ( abbreviation, name, harvesterurl, forharvest, countrycode ) values ( 'TAPortal', 'JSON-Sample', 'http://technology-assessment.info/run/json/sample', 1, 'AT' );
insert into #__institute ( abbreviation, name, harvesterurl, forharvest, countrycode ) values ( 'TAPortal2', 'JSON-Sample2', 'http://technology-assessment.info/run/json/sample2', 1, 'AT' );
select * from #__institute;







drop table if exists #__expert;

create table #__expert (
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

create index x_expert_sur on #__expert ( surname );
create index x_expert_fir on #__expert ( firstnames );
create index x_expert_fkins on #__expert ( fkinstitute );

insert into #__expert ( surname, firstnames, fkinstitute ) values ( 'Meier', 'Anton', 1 );
select * from #__expert;













drop table if exists #__project;

create table #__project (
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

create index x_project_sht on #__project ( shorttitle );
create index x_project_lot on #__project ( longtitle );
create index x_project_std on #__project ( startdate );
create index x_project_end on #__project ( enddate );
create index x_project_fkcon on #__project ( fkcontactperson );

insert into #__project ( shorttitle, longtitle, startdate, partnercountries, fkcontactperson ) values ( 'Proj1', 'Project1', '2000-07', 'EU', 1 );
select * from #__project;











drop table if exists #__publication;

create table #__publication (
  id integer not null auto_increment,
  
  quotation varchar(500) not null,
  shortdescription varchar(500) not null,
  publdate date,
  publtype varchar(20),
  fkinstitute integer,
  
  primary key(id)
);

create index x_publication_quo on #__publication ( quotation );
create index x_publication_pud on #__publication ( publdate );
create index x_publication_put on #__publication ( publtype );
create index x_publication_fkins on #__publication ( fkinstitute );

insert into #__publication ( quotation, shortdescription, publdate, publtype, fkinstitute ) values ( 'Publ1', 'publ publ publ', '2000-07-01', 'article', 1 );
select * from #__publication;











drop table if exists #__harvest;

create table #__harvest (
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

create index x_harvest_fkins on #__harvest ( fkinstitute );
create index x_harvest_stt on #__harvest ( starttime );
create index x_harvest_url on #__harvest ( url );
create index x_harvest_ent on #__harvest ( endtime );











drop table if exists #__harvesterlog;

create table #__harvesterlog (
  id integer not null auto_increment,
  
  point datetime not null,
  message varchar(500),
  exception varchar(500),
  fkinstitute integer,
  harvestid integer,
    
  primary key(id)
);

create index x_harvest_poi on #__harvesterlog ( point );
create index x_harvest_fkins on #__harvesterlog ( fkinstitute );
create index x_harvest_hai on #__harvesterlog ( harvestid );

