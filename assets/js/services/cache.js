import React from 'react';

const cache = {};

function set(key, data){
    cache[key] = {
        data: data,
        cachedAt: new Date().getTime()
    }
}

function get(key){
    //Quand je demande quelque chose qu'il y a dans le cache je reçoi une promesse
    //la promesse d'obtenir quelque
    return new Promise( (resolve) => {
        //la fonction resolve aura soit les données en cache soit null
        //on verifie la date du cache par rapport a la date de maintenant
        resolve(
            cache[key] && cache[key].cachedAt + 15*60*1000 > new Date().getTime()  
            ? cache[key].data 
            : null
        )
    } )
}
 
export default {
    set,
    get
};