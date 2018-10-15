# Stories

[![https://travis-ci.org/muratbsts/stories.svg?branch=master](https://travis-ci.org/muratbsts/stories.svg?branch=master)](https://travis-ci.org/muratbsts/stories)

Story sharing platform made with Laravel 5.7

## How to contribute

Look at the [trello board](https://trello.com/b/SOpyHA6t/stories) before you [fork the repository](https://github.com/muratbsts/stories/fork). Feel free after.

```shell
$ git clone git@github.com:USERNAME/stories && cd stories
$ cp .env.example .env # and set up your environment
$ composer install
$ yarn install # or npm install
$ php artisan key:generate
```

Check the `.env` file and update database and social service variables.

You can run with:

```shell
$ php artisan serve
```

Or you can setup a virtual host like `stories.dev`.

Create feature branch `git checkout -b great-feature`.

Commit `git commit -m 'great-feature is ready'`.

Push `git push origin great-feature`.

Create a new pull request.

**Note: A Dockerfile is will come soon.**

## Contributors

- [Murat Bastas](https://github.com/muratbsts)

## License

[MIT](https://github.com/muratbsts/stories/blob/master/LICENCE) © [Murat Bastas](https://github.com/muratbsts)
