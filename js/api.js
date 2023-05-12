
/*
import { MY_API_KEY } from './configAPI.js';

for (let i = 1; i <= 10; i++) {
    console.log(i);
    let xhr = new XMLHttpRequest();
    let url = "https://myanimelist.p.rapidapi.com/manga/" + i.toString();

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            if (response.title_ov !== undefined) {
                console.log(response)
                console.log(i + " | " + response.title_ov);
                console.log(response.statistics.score);
                console.log(response.information.authors[0].name);
                const genres = response.information.genres;
                for (let j = 0; j < genres.length; j++) {
                    console.log(genres[j].name);
                    // Exemple de traduction de l'anglais au français
                    const sourceText = genres[j].name;
                    console.log(sourceText);
                    const sourceLanguage = 'en';
                    const targetLanguage = 'fr';

                    const url = `https://translation.googleapis.com/language/translate/v2?key=${apiKey}`;
                    const data = {
                        q: sourceText,
                        source: sourceLanguage,
                        target: targetLanguage,
                    };

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                        .then(response => response.json())
                        .then(data => console.log(data.data.translations[0].translatedText))
                        .catch(error => console.error(error));


                }
            } else {
                console.log(i + " | Manga not found");
            };

            xhr.open("GET", url, true);
            xhr.setRequestHeader("X-RapidAPI-Key", MY_API_KEY);
            xhr.setRequestHeader("X-RapidAPI-Host", "myanimelist.p.rapidapi.com");

            xhr.send();
        }
    }
}

*/

const query = `
query ($search: String, $page: Int, $perPage: Int) {
  Page (page: $page, perPage: $perPage) {
    pageInfo {
      total
      perPage
      currentPage
      lastPage
      hasNextPage
    }
    media (search: $search, type: MANGA, isAdult: false, popularity_greater: 1000, sort: POPULARITY_DESC) {
      id
      title {
        romaji
        english
        french
        native
      }
      description (asHtml: false)
      coverImage {
        extraLarge
      }
      bannerImage
      startDate {
        year
        month
        day
      }
      endDate {
        year
        month
        day
      }
      status
      genres
      averageScore
      format
      staff {
        edges {
          role
          node {
            name {
              full
            }
          }
        }
      }
    }
  }
}`;

const variables = {
    search: "naruto", // votre recherche de manga
    page: 1, // la page de résultats que vous souhaitez obtenir
    perPage: 10 // le nombre de résultats par page que vous souhaitez obtenir
};

const url = 'https://graphql.anilist.co';

fetch(url, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
    body: JSON.stringify({
        query: query,
        variables: variables
    })
})
    .then(response => response.json())
    .then(data => {
        if (!data.data) {
            console.log("Aucun résultat trouvé.");
            return;
        }

        const mangaList = data.data.Page.media;
        mangaList.forEach(manga => {
            const title = manga.title.french || manga.title.romaji || manga.title.english || manga.title.native || '';
            const description = manga.description || '';
            const author = manga.staff.edges.filter(edge => edge.role === "Author")[0]?.node?.name?.full ?? '';
            const genres = manga.genres ? manga.genres.join(', ') : '';
            const format = manga.format || '';
            const status = manga.status || '';
            const startDate = manga.startDate ? `${manga.startDate.day}/${manga.startDate.month}/${manga.startDate.year}` : '';
            const endDate = manga.endDate ? `${manga.endDate.day}/${manga.endDate.month}/${manga.endDate.year}` : '';
            const score = manga.averageScore ? `${manga.averageScore}%` : '';
            const coverImage = manga.coverImage.extraLarge || '';
            const bannerImage = manga.bannerImage || '';

            console.log("Title: " + title);
            console.log("Description: " + description);
            console.log("Author: " + author);
            console.log("Genres: " + genres);
            console.log("Format: " + format);
            console.log("Status: " + status);
            console.log("Start Date: " + startDate);
            console.log("End Date: " + endDate);
            console.log("Score: " + score);
            console.log("Cover Image: " + coverImage);
            console.log("Banner Image: " + bannerImage);
            console.log("-----------------------");
        });
    })
    .catch(error => console.error(error));
