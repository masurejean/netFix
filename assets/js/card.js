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
                        return <Card info={value} key={index}
                        dCard={this.state.dCard} url ={this.props.url}
                        xhrUrl={this.props.xhrUrl}
                        session_id={this.props.session_id}
                         />
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
    function addToPref(id_movie)
    {
        fetch("url de la page qui  va effectuer l action "+"?id_movie=" + id_movie+"&id_user="+ props.session_id).then(
            (reponse) => reponse.text()
        ).then((result)=>console.log(result))
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
                {props.dCard ?<button type="button"
                onClick={()=>{goTosingle(props.info.id_movie)}} 
                className="btn btn-secondary">info</button> :""}

                <button type="button" 
                onClick ={()=>(addToPref(props.info.id_movie))} 
                className="btn btn-danger">AJOUTER A MA LISTE</button>
                
        </div>
    )
}

ReactDOM.render(
<CardsFrame 
    filmsProps={films} 
    displayCard={dCard}
    url={url}
    xhrUrl = {xhrUrl}
    session_id={session_id}

    >

    </CardsFrame>,document.getElementById('cardsFrame'));