var result = 'tt2935510';

fetch("https://series-movies-imdb.p.rapidapi.com/movie/details/"+result, {
	"method": "GET",
	"headers": {
		"x-rapidapi-key": "fea82aca20msh09e0680190c7a7ep178f22jsna58827443fdf",
		"x-rapidapi-host": "series-movies-imdb.p.rapidapi.com"
	}
})
.then(response => {
	console.log(response);
	document.write(response);
})
.catch(err => {
	console.error(err);
});