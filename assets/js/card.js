class CardsFrame extends React.Component {
    constructor(props) {
        super(props);
        this.state = {films:props.filmsProps,
             dCard : props.displayCard,
             url: props.url

            }
    }
    render() {
        return (
            <div className="cardsFrame">
                {
                    this.state.films.map((value,index)=>{
                        return <Card info={value} key={index} dCard={this.state.dCard} url ={this.props.url}/>
                    })
                }
            </div>
        )
    }
}

function Card(props) {
    function goTosingle(id_movie){
        location.href = props.url + "?id_movie="+id_movie;

    }
    return (
        <div className="card mb-3">
            <h3 className="card-header" id="title">{props.info.title}</h3>
            <img className="imgFilm" src={props.info.urlFilm} alt=""/>
                <div className="card-body">
                    <p className="card-text" id="plot">{props.info.plot}</p>
                </div>
                <ul className="list-group list-group-flush">
                    <li className="list-group-item" id="year">{props.info.year}</li>
                    <li className="list-group-item" id="genre">{props.info.genres}</li>
                    <li className="list-group-item" id="directors">{props.info.directors}</li>
                    <li className="list-group-item" id="cast">{props.info.cast}</li>
                </ul>
                {props.dCard ?<button type="button" onClick={()=>{goTosingle(props.info.id_movie)}} className="btn btn-secondary">info</button> :""}

                <button type="button" className="btn btn-danger">AJOUTER A MA LISTE</button>
                
        </div>
    )
}

ReactDOM.render(
<CardsFrame 
    filmsProps={films} 
    displayCard={dCard}
    url={url}
    >

    </CardsFrame>,document.getElementById('cardsFrame'));