import React from 'react';
import Carousel from '../components/Carousel';


const HomePage = (props) => {

    

    return ( 
        <>
          <div className="container">
            <div className="row">
              <div className="col-12 offset-lg-2 col-lg-8">
                <Carousel />
              </div>
            </div>
          </div>
        </>
      );
}
 
export default HomePage;