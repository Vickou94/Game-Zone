
// Utilisation de l'API https://rawg.io/apidocs pour afficher une librairie de jeux

$('#name').on("input", function() {
    let dInput = this.value;
    getVideoGameName(dInput);
});

function getVideoGameName(input){
    let key = 'a4cd997828d942da9312f8a5a346c019';
    let results_per_page = '50';
    let url = "https://api.rawg.io/api/games?key="+key+"&search="+input + "&page_size=" + results_per_page ;
        $.ajax({
        type: 'GET',
        url: url
    }).done(function(data) { 
        let games = [];
        for(game of data.results) {
      games.push(
        `
      <div class="card">
        <div class="card-image">
          <img class="game-image" src="${game.background_image}">
          <h3 class="card-title">${game.name}</h3>
          <p class="card-description"> Note Metacritic : ${game.metacritic}/100</p>
        </div>
      </div>
        `);
    }
    document.getElementById('liste_jeux').innerHTML= games.join("");
    });
}