php artisan crud:generate Domaines --fields="name#string;description#longtext; slug#string" --validations="name#min:10|max:500|required;slug#min:5|required" --indexes="" --foreign-keys="user_id#id#users#cascade" --relationships="" --localize=yes --locales=fr --model-namespace=Models --view-path=forum --controller-namespace=Forum


php artisan crud:generate Categories --fields="user_id#integer;parent_id#integer;order#integer;name#string;color#string; slug#string" --validations="name#min:10|max:500|required" --indexes="" --foreign-keys="user_id#id#users#cascade" --relationships="" --localize=yes --locales=fr --model-namespace=Models --view-path=forum --controller-namespace=Forum

php artisan crud:generate Discussions --fields="categorie_id#integer;user_id#integer;title#string;sticky#select#options=0,1;views#integer;answered#select#options=0,1; slug#string;color#string" --validations="title#min:10|max:500|required;categorie_id#required;" --indexes="" --foreign-keys="user_id#id#users#cascade;categorie_id#id#categories#cascade" --relationships="" --localize=yes --locales=fr --model-namespace=Models --view-path=forum --controller-namespace=Forum

php artisan crud:generate Posts --fields="discussion_id#integer;user_id#integer;body#longtext;markdown#select#options=0,1;locked#select#options=0,1;" --validations="body#min:10|max:5500|required;discussion_id#required;" --indexes="" --foreign-keys="user_id#id#users#cascade;discussion_id#id#discussions#cascade" --relationships="" --localize=yes --locales=fr --model-namespace=Models --view-path=forum --controller-namespace=Forum


php artisan crud:view sujets --fields="title#string; body#text;categorie#select#options=technology,tips,health" --view-path="sujets"