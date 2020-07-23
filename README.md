# pricing

1. Introduction

Dans le cadre d’un test professionnel, on doit concevoir une solution qui doit gérer les jeux vidéo, selon leur état, mis par une entreprise sur une Marketplace avec la stratégie suivante : le produit mis en vente, à état égal, doit toujours être 1 centime moins cher que les concurrents. 

Si le jeu du concurrent est en meilleur état que celui de l’entreprise qui le vend alors cette dernière devra vendre le jeu 1 euro moins cher. Ces règles doivent obéir à la limite d’un prix plancher.

2. Analyse conceptuelle

On peut proposer le diagramme de classe suivant pour résoudre la stratégie mise en place par le vendeur :

 
Figure 1 : diagramme de classe de la stratégie du vendeur

Comme le montre la figure 1, on a créé 4 tables :

User : l’utilisateur, ici, est générique. Cela veut dire qu’il peut-être soit un administrateur soit un vendeur ; l’attribut « rôle » permet de le déterminer. Il dispose aussi d’un pseudo, d’un mot de passe dont MySQL va faire le « hash » et d’un email.

Product: c’est un produit qu’on va créer dans l’application et qui va être enregistré dans la base de données.

ProductForSale : Ce sont les exemplaires du jeu qu’on va placer sur la Marketplace suivant un prix plancher et un prix maximal ; ce dernier correspond au prix de vente après calcul algorithmique.

State: c’est une table qui va stocker les différents états du jeu vidéo mis sur la Marketplace ainsi qu’un « rank » de 1 à 5 dont on va se servir pour la construction de la stratégie de vente du produit.

Pour concevoir l’algorithme de la stratégie de prix, on va concevoir un diagramme d’activité :

 
Figure 2 : diagramme d’activités de la stratégie

Dans l’application, on a créé deux types de rôles : un rôle administrateur et un rôle vendeur.
Le rôle vendeur (qui correspond à un utilisateur inscrit) va pouvoir, uniquement, proposer des produits à vendre et chercher des jeux alors que les administrateurs, en plus de vendre, vont pouvoir gérer les différents utilisateurs, c’est-à-dire les vendeurs.
Enfin, à la suite du calcul, on affiche la liste des vendeurs par nom du produit classé en groupe d’état et par prix croissant donc de l’offre la plus intéressante à l’offre la moins intéressante pour un même produit.
