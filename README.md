# Nested-sets

Страница состоит из двух частей:
1. Форма для подачи запроса на генерирование дерева. Форма состоит из:
* Поля ввода количества узлов задаваемых к генерированию дерева;
* Кнопка "Генерировать дерево";
* Область для вывода сообщений;
2. Область просмотра дерева. Данная область отображает дерево или его части.

Выполняемые функции:
* При клике на кнопку "Генерировать дерево" скрипт должен генерировать данные (случайным образом) описывающие структуру будущего дерева и записывать их в БД:
* Используемый алгоритм построения дерева - Nested Sets
* Каждый узел имеет имя, равное идентификатору узла
* При переходе на главную страницу сайта (без указания дополнительных параметров или с указанием неправильных) - на странице выводится все дерево целиком;
* При переходе на страницу /thread/ID1,ID2,...,IDn - выводится n-количество веток, согласно указанным узлам ID*. При этом все данные узлы должны быть детьми одного общего узла "0" 

# Установка

1. git clone https://github.com/razikov/Nested-sets.git
2. cp ./config/db.sample.php ./config/db.php и настроить. Настроить сервер для yii приложения.
3. cd ./Nested-sets
4. composer install
5. ./yii migrate/up
6. ./yii serve
7. http://localhost:8080/