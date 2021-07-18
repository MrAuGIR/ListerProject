import axios from 'axios';
import { USER_API } from '../config';

function register(user){
    return axios.post(USER_API,user);
}

export default{
    register
}