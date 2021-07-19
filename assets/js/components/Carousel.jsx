import React, { useState } from 'react';
import Img from './Img';
import image1 from '../../img/illustrations/edit_page.png'
import image2 from '../../img/illustrations/home_page.png'
import image3 from '../../img/illustrations/view_page.png'

const Carousel = (props) => {

    const listeImages = [
      {
        id: "1",
        src: image1,
        alt: "editer une liste"
      },
      {
        id: "2",
        src: image2,
        alt: "Page d'accueil"
      },
      {
        id: "3",
        src: image3,
        alt: "Page de visualization"
      },
    ];

    return ( 
        <>
            <div id="carouselExampleIndicators" className="carousel slide" data-bs-ride="carousel">
                <div className="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" className="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div className="carousel-inner">
                    <div key={listeImages[0].id} className="carousel-item active">
                        <img  src={listeImages[0].src}  alt={listeImages[0].alt} className="d-block w-100" />
                    </div>
                    <div key={listeImages[1].id} className="carousel-item">
                        <img  src={listeImages[1].src}  alt={listeImages[1].alt} className="d-block w-100" />
                    </div>   
                    <div key={listeImages[2].id} className="carousel-item">
                        <img  src={listeImages[2].src}  alt={listeImages[2].alt} className="d-block w-100" />
                    </div> 
                </div>
                <button className="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span className="visually-hidden">Previous</span>
                </button>
                <button className="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span className="carousel-control-next-icon" aria-hidden="true"></span>
                    <span className="visually-hidden">Next</span>
                </button>
            </div>
        </>
     );
}
 
export default Carousel;