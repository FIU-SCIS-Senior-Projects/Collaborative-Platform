#   Version 5.0 Documentation Overview

##Requirements

### Use Case Model

#### Admin Reports
![Admin Reports](https://github.com/FIU-SCIS-Senior-Project-2015-Spring/Collaborative-Platform-Ver-5.0/blob/develop/Documents/Images/UseCasesAdminReports.jpg "Admin Reports")

#### Senior Project Website Integration
![SPWS Integration](https://github.com/FIU-SCIS-Senior-Project-2015-Spring/Collaborative-Platform-Ver-5.0/blob/develop/Documents/Images/SPW%20Integration.png "SPWS Integration")

#### Collaborative Tools
![Collaborative Tools](https://github.com/FIU-SCIS-Senior-Project-2015-Spring/Collaborative-Platform-Ver-5.0/blob/develop/Documents/Images/Collaborative%20Tools.png "Collaborative Tools")

### Class Diagram
![Class Diagram](https://raw.githubusercontent.com/FIU-SCIS-Senior-Project-2015-Spring/Collaborative-Platform-Ver-5.0/develop/Documents/Images/AdminReportsClassDiagram.png "Class Diagram")

***

### Sequence Diagram
![Class Diagram](https://raw.githubusercontent.com/FIU-SCIS-Senior-Project-2015-Spring/Collaborative-Platform-Ver-5.0/develop/Documents/Images/SequenceAdminPullMenteeReport.png "Admin Pull Mentee Reports")

***

## System Design

### System Architecture
#### MVC Yii Framework
![MVC Yii Framework](https://github.com/FIU-SCIS-Senior-Project-2015-Spring/Collaborative-Platform-Ver-5.0/blob/develop/Documents/Images/SystemDesignMVC.jpg "MVC Yii Framework")


### Subsystems Decomposition
####List of Subsystems:
1.	Registration and Access Point Subsystem
2.	Mentoring Subsystem
3.	Remote Judge Subsystem
4.	Communication Subsystem
5.	Virtual Job Fair

####Description
1.	Registration and Access Point Subsystem
	The registration and access point subsystem will be the main entry point for our platform. This will facilitate the process across the user database. Since there will be one login for each individual module, the access point is simplified into one subsystem. This subsystem will also cover the creation of new users and the retrieval of passwords for current users.

2. Mentoring Subsystem
	The mentoring subsystem will cover the essentials of the mentoring module. Specifics to the mentoring module are separated into this subsystem. These functionalities include the ability to retrieve information from the senior project website or from LinkedIn. It also covers the essential workflow of the ticketing system for issues created by mentees for the different types of mentors.

3. Remote Judge Subsystem
	The remote judge subsystem will cover the fundamentals from the remote judge module. These functionalities are essential to the grading and viewing of projects done within the platform. The subsystem covers main requirements for the necessary two way communication found when giving feedback or grading an individual from certain projects. 

4. Communication Subsystem
	The communication subsystem is a key subsystem that provides functionality derived from the mentoring module.This communication will be vital to the ticket system as users may frequently send time-sensitive information regarding projects or questions made by mentees.

5. Virtual Job Fair
	The virtual job fair system covers a large amount of functionality. The system plays an essential portion of the collaborative platform as its own module. The system allows a streamlined online interaction system for employers and employees/future employees alike. Document sharing and editing is important within the system as well as screen sharing for interview questions and overall viewpoint on work. 

### Persistent Data
#### ER Diagram
![ER](https://github.com/FIU-SCIS-Senior-Project-2015-Spring/Collaborative-Platform-Ver-5.0/blob/develop/Documents/Images/EntityRelationshipModel.png "ER")


***
## Project Planning

### Gantt Chart (Project Schedule)
![Gantt Chart](https://github.com/FIU-SCIS-Senior-Project-2015-Spring/Collaborative-Platform-Ver-5.0/blob/develop/Documents/Images/GanttChart.tiff "Gantt")
