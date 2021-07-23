import Axios from "axios";
import jwtDecode from "jwt-decode";
import { LOGIN_API } from "../config";

/**
 * LOGOUT (Delete token)
 */
function logout(){
    window.localStorage.removeItem("authToken");
    delete Axios.defaults.headers['Authorization'];
}

/**
 * Http request login
 * @param {object} credentials
 * @return
 */
async function login(credentials){

    return await Axios.post(LOGIN_API, credentials)
        .then(response => response.data.token)
        .then(token => {
            window.localStorage.setItem("authToken", token);
            setAxiosToken(token);
        })
}

/**
 * Set jwt token bearer on Axios default header
 * @param {string} token JWT Token
 */
function setAxiosToken(token){
    Axios.defaults.headers['Authorization']= "Bearer "+ token ;

}

/**
 * Get saved token at the application's start
 */
function setup(){

    //check if token exist
    const token = window.localStorage.getItem('authToken');
    

    if(token){

        //j'extirpe la donné exp de data renvoyé par jwtDecode(token)
        const {exp} = jwtDecode(token);
        if( exp * 1000 > new Date().getTime() ){
            setAxiosToken(token);
            console.log(token);
        }
    }
}

/**
 * Check if user is login and authenticade
 */
function isLogin(){

    const token = window.localStorage.getItem('authToken');

    if(token){
        const {exp} = jwtDecode(token);
        // *1000 for having the two datetime in ms
        if( exp*1000 > new Date().getTime() ){
            return true;
        }
        return false;
    }
    return false;
}

export default{
    login,
    logout,
    setup,
    isLogin
};