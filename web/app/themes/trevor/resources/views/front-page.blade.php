@extends('layouts.app')

@section('content')

  @foreach($content as $row)

    @if($row->layout != 'portfolio')

      <div id="{{ $row->layout }}" class="block {{ $row->layout }}">
        @if($row->layout == 'hero')
          <div class="hero__inner">
            <div class="hero__content">
              <div class="heading">{{ $row->heading }}</div>
              <div class="subheading">{{ $row->subheading }}</div>
              @if($row->call_to_action)
                <div class="call-to-action">
                  <a class="button" href="{{ $row->call_to_action->url }}"
                    target="{{ $row->call_to_action->target}}">
                    {{ $row->call_to_action->title }}
                  </a>
                </div>
              @endif
            </div>
            <div class="hero__image">
              <img src="{{ $row->landscape_image->sizes['large'] }}">
              @if($row->portrait_image)
                <img src="{{ $row->portrait_image->sizes['large'] }}">
              @endif
            </div>
          </div>
        @elseif($row->layout == 'contact')
          <div class="contact__inner">
            <div class="email">
              <a href="mailto:{{ $row->email }}">{{ $row->email }}</a>
            </div>
            <div class="info">
              {!! $row->info !!}
            </div>
            <div class="social">
              @foreach($row->social as $social)
                <a href="{{ $social->url }}" target="_blank"
                  title="{{ $social->name }}">
                  {!! $social->icon !!}
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </div>

    @else

          @foreach($row->portfolios as $portfolio)
            <div class="portfolio portfolio__{{  $portfolio->handle }} block"
              id="portfolio__{{  $portfolio->handle }}">
              <h3>{{ $portfolio->title }}</h3>
              <div class="portfolio__description">{!! $portfolio->content !!}</div>
              <!-- <img src="{{ $portfolio->featured_image }}"> -->
              <div class="portfolio__gallery">
                @foreach($portfolio->gallery as $image)
                  <img src="{{ $image['sizes']['large'] }}"
                    style="
                    width: {{ rand(350, 650)/10 }}%;
                    padding: 0 {{ rand(0, 24)/2 }}rem {{ rand(0, 24)/2 }}rem {{ rand(4, 12)/2 }}rem;
                    ">
                @endforeach
              </div>
            </div>
          @endforeach

    @endif

  @endforeach

  <!-- <div id="hero" class="block">
       hero
       main benefit statement
       call to action
       </div>
       <div id="process" class="block">
       process?
       </div>
       <div id="portfolio" class="block">
       <div id="portraiture" class="slide">
       portraiture
       description of process
       gallery of images
       </div>
       <div id="editorial" class="slide">
       editorial
       description of process
       gallery of images
       </div>
       </div>
       <div id="next-steps" class="block">
       next steps
       overcome objections
       Just call me, let's do coffee, everyone's nervous about getting their photo taken.
       </div>
       <div id="contact" class="block">
       Contact info
       form
       contact details
       </div> -->
@endsection
