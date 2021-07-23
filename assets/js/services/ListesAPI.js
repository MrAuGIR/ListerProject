import axios from 'axios';
import Axios from 'axios';
import {LISTE_API} from '../config';
import Cache from './Cache';

async function findAll(){
    //check cache
    const cachedListes = await Cache.get('listes');

    if(cachedListes) return cachedListes;

    return Axios.get(LISTE_API)
            .then(response => {
                const listes = response.data['hydra:member'];
                Cache.set('listes', listes);
                return listes;
            });
}


async function find(id){
    const cachedListes = await Cache.get('listes.' + id);
    if(cachedListes) return cachedListes;

    return Axios.get(LISTE_API + '/' + id)
            .then( response => {
                const liste = response.data;
                Cache.set('listes.'+id, liste);
                return liste;
            })
}

function create(){
    return Axios.post(LISTE_API, liste)
            .then( async response => {
                const cachedListes = await Cache.get('listes');
                if(cachedListes){
                    Cache.set('listes', [...cachedListes, response.data]);
                }
                return response;
            })
}

function deleteListes(id){
    return Axios.delete(LISTE_API + "/" + id);
}


export default{
    findAll:findAll,
    find:find,
    create:create,
    delete:deleteListes
}