drop table if exists joomla_institute;

create table joomla_institute (
  id integer not null auto_increment,
  
  abbreviation varchar(10) not null,
  name varchar(250) not null,
  countrycode varchar(2),
  zipcode varchar(10),
  city varchar(40),
  street varchar(50),
  description varchar(1000),
  url varchar(500),
  
  harvesterurl varchar(500),
  forharvest tinyint(1),
  
  primary key(id)
);

create index x_institute_abb on joomla_institute ( abbreviation );
create index x_institute_nam on joomla_institute ( name );
create index x_institute_cou on joomla_institute ( countrycode );

insert into joomla_institute ( abbreviation, name, description, url, countrycode, harvesterurl, forharvest ) 
values ( 'ITA',  'Institute of Technology Assessment', 'The Institute of Technology Assessment (ITA) is an interdisciplinary research institute for the analysis of technological change, focusing on societal conditions and shaping options and impacts. Scientific technology assessment applies a broad array of methods stemming from a multitude of fields.', 'http://www.oeaw.ac.at/ita',  'AT', 'http://technology-assessment.info/run/json/sample', 1 );

insert into joomla_institute ( abbreviation, name, description, url, countrycode, harvesterurl, forharvest ) 
values ( 'ITAS', 'Institute for Technology Assessment and Systems Analysis', 'The Institute for Technology Assessment and Systems Analysis (ITAS) researches scientific and technological developments concerning systemic relations and technology impacts with a focus on environmental, economic, social, and political-institutional questions. The alignment of research and technology policy, the influence on the design of socio-technological systems regarding, e.g., the criteria of sustainable development, as well as the realization of discursive processes on open and controversial questions on technology policy are some of the most important aims. The results of research and policy advice are publicly available.', 'http://www.itas.kit.edu/english/', 'DE', 'http://technology-assessment.info/run/json/sample2', 1 );

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

insert into joomla_expert ( exptitle, surname, firstnames, email, phonenumber, expertise, emplurl, fkinstitute ) 
values ( 'Dr.', 'Gazso', 'Andre', 'agazso@oeaw.ac.at', '(+43-1-)51581-6578 ', 'nanotechnology,risik management,risk communication', 'http://www.oeaw.ac.at/ita/ebene3/e2-4a.htm#AG', 1 );

insert into joomla_expert ( exptitle, surname, firstnames, email, phonenumber, expertise, emplurl, fkinstitute ) 
values ( 'Dipl.-Phys.', 'Fleischer', 'Torsten', 'torsten fleischer@kit.edu', '0721 608-24571', 'nanotechnologie,energy,transport', 'http://www.itas.kit.edu/mitarbeiter_fleischer_torsten.php', 2 );

insert into joomla_expert ( exptitle, surname, firstnames, email, phonenumber, expertise, emplurl, fkinstitute ) 
values ( 'Mag.', 'Cas', 'Johann', 'jcas@oeaw.ac.at', '(+43-1-)51581-6581', 'privacy in the information society, privacy enhancing technologies', 'http://www.oeaw.ac.at/ita/e1-4.htm#JC', 1 );

insert into joomla_expert ( exptitle, surname, firstnames, email, phonenumber, expertise, emplurl, fkinstitute ) 
values ( 'Dr.', 'Peissl', 'Walter', 'wpeissl@oeaw.ac.at', '(+43-1-)51581-6584', 'privacy, telematics in health care, participatory methods in Technology Assessmen', 'http://www.oeaw.ac.at/ita/e1-4.htm#WP', 1 );

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

insert into joomla_project ( shorttitle, longtitle, shortdescription, startdate, enddate, partnercountries, homepage, fkcontactperson ) 
values ( 'NanoTrust', 'Integrative Analysis of the State of Knowledge Regarding Health and Einvironmental Risks of Nanotechnology, Including Establishing a Clearing House', 'The central aim of this research project is to continuously survey, summarise and analyse the available knowledge on health and environmental risks of nanotechnology. For the first time in Austria, these important aspects of technology development will be investigated in a systematic way rather than on the level of individual R&D projects, that is on a meta level. We aim at making transparent possible gaps in research and differing evaluations. This so-called “risk radar” will be the basis for a “clearing house” for questions regarding potential health and environmental risks. The nano team at ITA will serve as an information hub and as a discussion catalyst: A service point for questions regarding the assessment of safety aspects will be established aimed at serving both the general public, public administration and the nano research community.', '2007-10-01', '2010-09-01', 'EU', 'http://nanotrust.ac.at', 1 );

insert into joomla_project ( shorttitle, longtitle, shortdescription, startdate, enddate, partnercountries, homepage, fkcontactperson ) 
values ( 'Risiko-Governance', 'Contribution to the risk governance of particulate nanomaterials by evidence mapping of their potential health risks', 'The aim of the project is to systematize and map the knowledge available for a hazard assessment of selected particulate nanomaterials. This knowledge is heterogeneously distributed among persons and scientific disciplines. For this reason, a survey of the state-of-the-art in research on health effects of selected MPN will be conducted. The resulting data base will be used for the discursive evidence mapping method, which will be tested for its potential to identify and characterise the hazard of MPN (hazard assessment) and optimized, if necessary.', '2010', '2014', 'EU', 'http://www.itas.kit.edu/projekte_flei10_parna.php', 2 );

insert into joomla_project ( shorttitle, longtitle, shortdescription, startdate, enddate, partnercountries, homepage, fkcontactperson ) 
values ( 'Privacy 2.0 – AK3', 'New challenges for data protection in Austria', 'In 2008, ITA pursued a short investigation into recent developments in areas highlighted earlier in a study of 2000. Objective of the study was to discuss relevant issues for actors in consumer protection, policy and scientific discourse on privacy and to identify areas with a need for action.', '2008', '2009', 'EU', '-', 3 );

insert into joomla_project ( shorttitle, longtitle, shortdescription, startdate, enddate, partnercountries, homepage, fkcontactperson ) 
values ( 'EuroPriSe', 'EuroPriSe - European Privacy Seal', 'One of the main problems facing the information society is a lack of transparency in IT products and services causing a lack of trust in IT solutions. Citizens and business often need “a good faith belief” when using privacy relevant IT products and services. Technical developments are made by the hour and the possibilities of electronic surveillance are huge. Currently there is no transparent guidance for choosing a data security and privacy compliant product in Europe. The aim of this project was to introduce and disseminate a transparent European product privacy certificate that fosters consumer protection, civil rights and acceptance of privacy by marketing mechanisms as well as an increase of market transparency for privacy relevant products that leads to an enlargement of the market for Privacy Enhancing Technologies and finally an increase of trust in IT.', '2007', '2009', 'EU', '-', 4 );

insert into joomla_project ( shorttitle, longtitle, shortdescription, startdate, enddate, partnercountries, homepage, fkcontactperson ) 
values ( 'PRISE', 'Privacy enhancing shaping of security research and technology - A participatory approach to develop acceptable and accepted principles for European Security Industries and Policies', 'The project PRISE was funded as a supporting activity under the Preparatory Action on the enhancement of the European industrial potential in the field of Security Research (PASR) of the European Commission. The objective of PRISE was to promote a secure future for European citizens based on innovative security technologies and policies in line with privacy protection and human rights in general. PRISE developed guidelines and support for security solutions with a particular emphasis on human rights, human behaviour and perception of security and privacy. It provided assistance to the European Union in shaping their forthcoming security programme in order to achieve active contributions for maintaining security of its citizens with due regard for fundamental rights and democratic accountability at EU and national level.', '2006-01-01', '2008-01-01', 'EU', '-', 4 );

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
values ( 'Gazsó, A.; Gressler, S.; Schiemer, F. (Hrsg.) (2007) nano - Chancen und Risiken aktueller Technologien.; Wien: Springer (246 Seiten).www.springer.com/materials/nanotechnology/book/978-3-211-48644-3', '2007-06-26', 'book', 1 );

insert into joomla_publication ( quotation, publdate, publtype, fkinstitute ) 
values ( 'Peissl, W. (2010) Privacy in Europe from a TA perspective. In: Gutwirth, S.; Poullet, Y.; De Hert, P. (Hrsg.), Data Protection in a Profiled World (CPDP – Computers, Privacy and Data Protection 2009); Berlin: Springer, S. 247-526.', '2010-01-01', 'book', 1 );

insert into joomla_publication ( quotation, publdate, publtype, fkinstitute ) 
values ( 'Sotoudeh, M.; Peissl, W. (20.09.2011) TA in Europa – Status quo und Zukunft. ITA-Newsletter (September 2011), S. 7 f. .http://epub.oeaw.ac.at/ita/ita-newsletter/NL0911.pdf#7', '2011-01-01', 'article', 1 );

insert into joomla_publication ( quotation, publdate, publtype, fkinstitute ) 
values ( 'Cas, J. (2011) Ubiquitous Computing, Privacy and Data Protection: Options and Limitations to Reconcile the Unprecedented Contradictions. In: Gutwirth, S.; Poullet, Y.; De Hert, P.; Leenes, R. (Hrsg.), Computers, Privacy and Data Protection: an Element of Choice: Springer, S. 139-169 .Abstract http://dx.doi.org/10.1007/978-94-007-0641-5_7', '2011-01-01', 'book', 1 );

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

