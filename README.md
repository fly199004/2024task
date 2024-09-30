- Manav
- Al
- QI
- Thomas
- Manaswi

## Installation

Use either Frontend or Backend instruction to setup for development. Make sure you have `xampp` installed

### Backend
- Download xampp
- Find your xampp folder in your PC/Mac. There should be a folder named `htdocs` and put the repository `fa24-semesterproject-dormraters` in here
- Open xampp, and start the Apache and MySQL server
- Go to your browser and visit `localhost/fa24-semesterproject-dormraters/backend/api/` This will initialize the table required in MySQL
- The path in the url follows the same path of whatever file you're working in whatever directory

##### Notes
- The backend/api/ directory is where you should write your api routes. Name your file based on whatever your route is for. So if you're working on anything dorm related, please use the folder called `dorms` and name the file based on your action. So if you're writing api to get all the dorms: `getAllDorms.php`. Same for users, use `users` folder, and yada yada. You get the gist.

- There's a .env file, if you setup the way I did, there should no changes be required to the variable. But if there is and you need help, hit me up and I'll show you how to!


### Frontend
- Ignore the App.jsx file. You can delete teh fetchData() function, and the useEffect() function. Otherwise you'll get error, since the url it's trying to fetch doesn't exist for the frontend peeps.
