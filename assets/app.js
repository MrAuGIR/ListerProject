/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import 'react-toastify/dist/ReactToastify.css';

//import de react
import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import Navbar from './js/components/NavBar';
import HomePage from './js/pages/HomePage';
import { HashRouter, Switch, Route, withRouter, Redirect } from 'react-router-dom';
import ListesPage from './js/pages/ListesPage';
import LoginPage from './js/pages/LoginPage';
import RegisterPage from './js/pages/RegisterPage';
import LoginAPI from './js/services/LoginAPI';
import loginContext from './js/contexts/loginContext';
import { ToastContainer, toast } from 'react-toastify';


LoginAPI.setup();

const App = () => {

    const [isLogin, setIsLogin] = useState(LoginAPI.isLogin());

    //on donne les props history,... du cmposant Router à notre NavBar
    const NavBarWithRouter = withRouter(Navbar);

    const contextValue = {
        isLogin: isLogin,
        setIsLogin: setIsLogin
    }

    return(
        <loginContext.Provider value={contextValue} >
            <HashRouter>
                <NavBarWithRouter />
                <main className="container pt-5">
                    <Switch>
                        <Route path="/login" component={LoginPage} />
                        <Route path="/register" component={RegisterPage} />
                        <Route path="/listes" component={ListesPage} />
                        <Route path="/" component={HomePage} />
                    </Switch>
                </main>
            </HashRouter>
            <ToastContainer position={toast.POSITION.BOTTOM_CENTER} />
        </loginContext.Provider>
    ); 
}

const rootElement = document.querySelector('#app');
ReactDOM.render(<App />, rootElement);