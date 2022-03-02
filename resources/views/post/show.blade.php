@extends('layouts.layout')

@section('title', $post->title)

@section('meta_keys', $post->meta_keys)
@section('meta_description', $post->description)
@section('canonical', route('posts.front.show', [$post, $post->id]))

@section('head')
            <!--Yandex JS Social buttons in post footer additional styles-->
            <style>
               .ya-share2__list {
                    display: flex!important;
                    flex-wrap: wrap;
                    justify-content: space-evenly!important;
                }
            </style>
@endsection


@section('main')

    <div class="post container">

        {{--Breadcrumb--}}
        <div class="breadcrumbs">
            <a href="/">Главная</a>
            <a href="{{ route('categories.front.show', [$post->category]) }}">{{ $post->category->title }}</a>
            <span class="this-page">{{ $post->title }}</span>
        </div>

        <h1 class="title">{{ $post->title }}</h1>

        {{--Only for auth user--}}
        {{--TODO Authorize edit--}}
        <div>
            @auth
                <a target="_blank" href="{{ route('posts.edit', $post) }}">Edit</a>
            @endauth
        </div>


        {{--Meta--}}
        <div class="meta">
            <div>
                <div>Опубликовано:</div>
                {{ $post->created_at }}
            </div>
            @if( $post->created_at != $post->updated_at)
                <div>
                    <div>Обновлено:</div>
                    {{ $post->updated_at }}
                </div>
            @endif

            <div>
                <div>Автор:</div>
                {{ $post->user->name }}
            </div>

            <div>
                <a href="#social-buttons">Поделиться</a>
            </div>

            <div>
                <a href="#comments">Комментарии</a>
            </div>

            <div>
                <a href="#related-posts">Другие записи</a>
            </div>
        </div>


        <div class="description">{{ $post->description }}</div>


        @if( isset($firstImage))
            @php

                $thumb = \App\Http\Controllers\Post\PostsController::THUMB['smallest'];

                /** @var \App\Models\Post\PostImage $firstImage */
                $pathToImage = storage_path('app/public/' . $firstImage->folder . '/'. $firstImage->filename);

                try {
                    $imSize = getimagesize($pathToImage);
                } catch (Exception $exception) {
                    $imSize[0] = 1000;
                    $imSize[1] = 500;
                }
            @endphp

            <div class="images-block @if( $imSize[0] < 720 && $post->files->count() <= 0) images-block-float @endif ">

                <div class="thumbnail">

                    <img loading="lazy" src="{{ asset('storage/' . $firstImage->folder . '/'. $firstImage->filename) }}"
                         alt="изображение для записи {{ $post->title}}"
                         width="{{ $imSize[0] }}"
                         height="{{ $imSize[1] }}">
                </div>

                <div class="small-images">

                    @forelse( $images as $key => $image)

                        <a data-fancybox="gallery"
                           href="{{ asset('storage/' . $image->folder . '/'. $image->filename) }}">
                            <img loading="lazy" src="{{ asset('storage/' . $image->folder . '/'. $thumb['str'] . '_' .
                                $image->filename) }}"
                                 width="{{ $thumb['w'] }}"
                                 height="{{ $thumb['h'] }}"
                                 alt="маленькая фотография картинка {{ mb_strtolower($post->title) }} - {{ $key }}">
                        </a>
                    @empty
                    @endforelse


                </div>

                <div class="post-files">
                    @forelse( $post->files as $file)
                        <a class="btn"
                           download
                           href="{{ asset('storage/' . $file->folder . '/' . $file->name) }}">
                            Скачать {{ $file->name }}
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        @endif



        {{--<div class="adv-before-article">--}}
        {{--@include('includes.adv-header')--}}
        {{--</div>--}}


        <post-contents></post-contents>


        <article>

            {{--TODO Need Sanitize data purifer--}}

            {{--Adsense before Post--}}
            <div class="adv-ads">
                <!-- qukenon 336-280 -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:336px;height:280px"
                     data-ad-client="ca-pub-8481515375748477"
                     data-ad-slot="3239673640"></ins>
            </div>


            {{--Article without escape chars--}}
            {!! $post->article !!}


            <div>

                {{--Adsense after Post - netboard - only non-mobile--}}
                <div class="adv-ads-after-article">
                    <!-- qukenon netboard 580-400 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:580px;height:400px"
                         data-ad-client="ca-pub-8481515375748477"
                         data-ad-slot="4228008608"></ins>

                </div>

                {{--Adsense after Post - 336-280 - only on Mobile--}}
                <div class="adv-ads-after-article-for-mobile">
                    <!-- qukenon 336-280 -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:336px;height:280px"
                         data-ad-client="ca-pub-8481515375748477"
                         data-ad-slot="3239673640"></ins>
                </div>
            </div>

        </article>

        @if( $tags->count())
            <section class="post-tags">
                <h2>Теги</h2>
                <div>
                    @forelse( $tags as $tag)
                        <a class="badge" href="{{ route('tags.front.show', $tag) }}">{{ $tag->name }}</a>
                    @empty
                        <span>Нет тегов</span>
                    @endforelse
                </div>
            </section>
        @endif

        <section id="social-buttons" class="social-buttons">
            <h2>Поделитесь записью пожалуйста:)</h2>

            {{--sharethis.com--}}
            <!--<div class="sharethis-inline-share-buttons"></div>-->




            <!--Yandex social Buttons-->
            <div class="ya-share2"
                data-curtain
                data-size="l"
                data-services="messenger,vkontakte,facebook,odnoklassniki,telegram,twitter,viber,whatsapp,moimir,skype,lj,blogger,digg,reddit">
            </div>

        </section>


        <section id="comments" class="vk-comments-form">
            <h2>Оставьте пожалуйста комментарий:)</h2>

            {{--VK Comment form--}}
            <div id="vk_comments"></div>


        </section>
    </div>

    {{--TODO Доделать комментарии--}}
    {{--<div class="comments container">--}}

    {{--    <div class="add-comment">--}}
    {{--        <h3>Оставить комментарий</h3>--}}
    {{--        @include('post.comments.add-comment')--}}

    {{--    </div>--}}

    {{--    @include('post.comments.single-comment')--}}
    {{--</div>--}}


    @include('post.related-posts', $relatedPosts)

@endsection

@section('script')

    <script>
        lazyLoadYouTube();
        lazyImages();

        function lazyImages() {
            let images = document.querySelectorAll('img');
            images.forEach(item => {
                item.loading = 'lazy';
            })
        }


        function lazyLoadYouTube() {
            let frameArr = document.querySelectorAll('.lazy-you');
            frameArr.forEach((item, index) => {
                let par = item.parentElement;
                par.id = 'video-id-' + index;
                item.remove();


                let addVideo = () => {
                    removeEventListener('scroll', addVideo)
                    let againParent = document.getElementById('video-id-' + index);
                    againParent.appendChild(item);
                }

                window.addEventListener('scroll', addVideo)
            })
        }


        function startGoogleAds() {
            window.removeEventListener('scroll', startGoogleAds);

            // Loop adv blocks
            for (let i = 0; i < 3; i++) {
                (adsbygoogle = window.adsbygoogle || []).push({});
            }
        }

        function startVK() {
            window.removeEventListener('scroll', startVK);

            VK.init({apiId: 7539161, onlyWidgets: true});
            VK.Widgets.Comments("vk_comments", {
                height: 'auto',
                limit: 15,
                attach: "*",
                autoPublish: 1
            });

        }

        function addFancyboxOptions() {
            $('[data-fancybox="gallery"]')
                .fancybox({hideScrollbar: false,});
        }
    </script>

    {{--Google Ads--}}
    <script
        async
        onload="window.addEventListener('scroll', startGoogleAds)"
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    {{--VK--}}
    <script
        async
        onload="window.addEventListener('scroll', startVK)"
        src="https://vk.com/js/api/openapi.js?168"></script>

    {{--Social buttons--}}
    <!--<script async src="https://platform-api.sharethis.com/js/sharethis.js#property=5f102b37c0b69e00123ab475&product=inline-share-buttons"></script>-->

    <!--Yandex social JS-->
    <script src="https://yastatic.net/share2/share.js"></script>


    {{--Fancybox--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <script defer src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script defer onload="addFancyboxOptions();"
            src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>



@endsection
