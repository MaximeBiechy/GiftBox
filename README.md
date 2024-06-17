# GiftBox

## Élèves :
- [Maxime BIECHY | MaximeBiechy](https://github.com/MaximeBiechy/)
- [Paul BRUSON | Dr-J-Watson](https://github.com/Dr-J-Watson)
- [Lenny COLSON | Okiles](https://github.com/Okiles)
- [Clément BRITO | TyrYoxan](https://github.com/TyrYoxan)

---

Installation du projet :

- Cloner le projet : "git clone git@github.com:MaximeBiechy/GiftBox.git"

- À la racine du projet créer un fichier ".env" et remplissez la avec les informations que l'on vous a donné.

- Dans le dossier gift.api/src et gift.appli/src, exécuter la commande : "compose install"

- A la racine du projet où se trouve le fichier docker_compose.yml, créez et lancez les containeurs avec la commande "docker compose create" puis "docker compose start"

- Dans le dossier "gift.appli/src/conf" créer un fichier "gift.db.conf.ini", remplissez ce fichier avec les informations que l'on vous a donné.

- Faire la même chose dans le dossier "gift.api/src/conf"

- Ouvrir phpmyadmin en se rendant sur l'URL "localhost:8081" dans un navigateur

- Dans phpmyadmin, se rendre dans la bd gift puis importer le fichier SQL/giftbox.schema.sql puis le fichier SQL/giftbox.data.sql

- GiftBox fonctionne désormais en localhost "localhost:8082" api : "localhost:8084/api/prestations" ou sur docketu "http://docketu.iutnc.univ-lorraine.fr:9082/"  api : "http://docketu.iutnc.univ-lorraine.fr:9084/api/prestations"

