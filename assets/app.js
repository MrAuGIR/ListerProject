/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

//import de react
import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import Navbar from './js/components/NavBar';
import HomePage from './js/pages/HomePage';
import { HashRouter, Switch, Route, withRouter } from 'react-router-dom';
import ListesPage from './js/pages/ListesPage';
import LoginPage from './js/pages/LoginPage';
import LoginAPI from './js/services/LoginAPI';



const App = () => {

    const [isLogin, setIsLogin] = useState(LoginAPI.isLogin());

    //on donne les props history,... du cmposant Router à notre NavBar
    const NavBarWithRouter = withRouter(Navbar);

    const contextValue = {
        isLogin: isLogin,
        setIsLogin: setIsLogin
    }

    return(
        <HashRouter>
            <NavBarWithRouter />
            <main className="container pt-5">
                <Switch>
                    <Route path="/login" component={LoginPage} />
                    <Route path="/listes" component={ListesPage} />
                    <Route path="/" component={HomePage} />
                </Switch>
            </main>
        </HashRouter>
    ); 
}

const rootElement = document.querySelector('#app');
ReactDOM.render(<App />, rootElement);