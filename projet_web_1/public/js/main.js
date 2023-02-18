import { createApp, ref } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'

const liste_de_commentaires = ref([])
const commentaire_infos = ref([])
const tableau_aleatoire = ref()

function choisirCommentairesAleatoirement(){
    tableau_aleatoire.value = Math.floor(Math.random() * liste_de_commentaires.value.length)
    commentaire_infos.value = liste_de_commentaires.value[tableau_aleatoire.value]
}

fetch("commentaires.json").then(resp => {
    resp.json().then(contenu => {
        liste_de_commentaires.value = contenu
        choisirCommentairesAleatoirement()
        setInterval(choisirCommentairesAleatoirement, 3000)
    })
})

const root = {
    setup() {
        return {
            commentaire_infos,
            liste_de_commentaires,
            tableau_aleatoire,
            choisirCommentairesAleatoirement,
        }
    }
}

createApp(root).mount("#app")