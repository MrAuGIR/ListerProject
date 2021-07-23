import React from 'react';
import { Link } from 'react-router-dom';


const Card = (title, description, id, handleDelete) => {
    return ( 
        <>
            <div key={id} className="card">
                <div className="card-body">
                    <h5 className="card-title">{title}</h5>
                    <p className="card-text">{description}</p>
                    <Link to={"listes/"+ id} className="card-link">Voir</Link>
                    <button onClick={handleDelete}  className="btn btn-danger">Suppression</button>
                </div>
            </div>
       
    </>
     )
}
 
export default Card;