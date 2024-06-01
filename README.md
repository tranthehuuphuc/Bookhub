# BookHub

A website for book lovers.

## Table of Contents
- [Description](#description)
- [Features](#features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
    - [For Windows](#for-windows)
    - [For MacOS](#for-macos)
    - [For MacOS using XAMPP](#for-macos-using-xampp)
- [Programming Languages, Frameworks, and Database](#programming-languages-frameworks-and-database)
- [Help](#help)
- [Authors](#authors)
- [Version History](#version-history)
- [License](#license)
- [Acknowledgments](#acknowledgments)

## Description
![BookHub](https://github.com/tranthehuuphuc/Bookhub/assets/152999205/05958863-33f6-4fb2-807b-91348db58c5d)

This is a web application project of Group 16, from the subject Web Application - NT208, at the University of Information Technology, Vietnam National University. This website is designed for buying and discussing books.

## Features
- Browse and purchase books
- Join discussions and reviews about books
- Manage personal profile and shipping information

## Getting Started

### Prerequisites
- **Windows**: Xampp, Wamp64
- **MacOS**: Mamp, Xampp

### Installation

#### For Windows:
1. **Install Xampp**: Download from [Xampp](https://www.apachefriends.org/download.html).
2. **Setup Apache and MySQL**:
   - Follow the installation instructions to set up Xampp.
   - Install Xampp in an easily accessible folder (e.g., `C:/xampp`).
3. **Prepare the Code**:
   - Locate the `htdocs` folder in your Xampp installation directory.
   - Copy and paste all your project files into the `htdocs` folder.
4. **Start Servers**:
   - Open Xampp.
   - Start both Apache and MySQL servers.
5. **Database Setup**:
   - Click on the `Admin` button next to MySQL to open phpMyAdmin.
   - Create a database named `bookhub`.
   - Import the provided `.sql` file into the `bookhub` database.
6. **Access the Website**:
   - Open your browser and navigate to `http://localhost/[your_project_folder]` to view the website.

#### For MacOS:
1. **Install Mamp**: Download from [Mamp](https://www.mamp.info/en/downloads/).
2. **Setup Mamp**:
   - Follow the installation instructions to set up Mamp.
3. **Prepare the Code**:
   - Locate the `htdocs` folder in your Mamp installation directory.
   - Copy and paste all your project files into the `htdocs` folder.
4. **Start Servers**:
   - Open Mamp.
   - Start both Apache and MySQL servers.
5. **Database Setup**:
   - Open your browser and go to `http://localhost:8888/phpMyAdmin`.
   - Create a database named `bookhub`.
   - Import the provided `.sql` file into the `bookhub` database.
6. **Access the Website**:
   - Open your browser and navigate to `http://localhost:8888/[your_project_folder]` to view the website.

#### For MacOS using XAMPP:
1. **Install XAMPP**: Download from [XAMPP official website](https://www.apachefriends.org/download.html).
2. **Setup XAMPP**:
   - Once downloaded, open the `.dmg` file and drag the XAMPP folder to your Applications directory.
   - Navigate to your Applications folder and open the XAMPP folder.
   - Double-click on the "xampp-control" application to launch the XAMPP Control Panel.
3. **Prepare the Code**:
   - Locate the `htdocs` folder within the XAMPP installation directory. By default, it's located at `/Applications/XAMPP/htdocs`.
   - Copy and paste all your BookHub project files into the `htdocs` folder.
4. **Start Servers**:
   - In the XAMPP Control Panel, start both Apache and MySQL servers by clicking the "Start" button next to each service.
5. **Database Setup**:
   - Open your web browser and go to `http://localhost/phpmyadmin`.
   - Create a new database named `bookhub`.
   - Import the provided `.sql` file into the `bookhub` database.
6. **Access the Website**:
   - Open your web browser and navigate to `http://localhost/[your_project_folder]` to view the BookHub website.

### Programming Languages, Frameworks, and Database
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL

## Help
If you encounter any issues, please feel free to reach out to the authors or check the documentation for guidance.

## Authors

Contributors names and contact info:
- Tran The Huu Phuc (22521143) - [@tranthehuuphuc](https://github.com/tranthehuuphuc)
- Tran Thi Thuy Vy (22521709) - [@vytr09](https://github.com/vytr09)
- Le Thi Bich Tuyen (22521630) - [@tuyen2201](https://github.com/tuyen2201)
- Nguyen Thi Hong Lam (20521518) - [@HLAM131](https://github.com/HLAM131)

## Version History
- v0.1: First deployment

## License
This project is licensed under the MIT License.

## Acknowledgments
We would like to thank our instructors and classmates for their support and contributions to this project.
