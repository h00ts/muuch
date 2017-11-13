@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ URL::previous() }}" class="btn btn-default pull-right">
                    <i class="material-icons">arrow_left</i> Regresar
                </a>
                <h3><i class="material-icons">trending_up</i> Impacto acumulado
                <small>al {{ date('d-m-Y', strtotime($created_at)) }}</small></h3> 
                <hr>
            </div>
        </div>
        <div class="impacto">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg viewBox="0 0 19 47" xmlns="http://www.w3.org/2000/svg" class="pull-left" style="height:100px"><title>Beneficiarios</title><path d="M4.628 14.835l-.185-.045-.594.045v11c-.122.213-.2.35-.23.412-.118.306-.324.514-.596.64-.266.124-.562.184-.863.184-.28 0-.55-.06-.806-.184-.258-.125-.467-.304-.617-.546-.032-.092-.048-.188-.07-.277-.015-.093-.055-.17-.113-.227v-12.56c.06-.27.114-.548.157-.823.045-.274.16-.53.346-.778.275-.67.772-1.305 1.493-1.902.717-.596 1.468-.89 2.268-.89h9.072c.553 0 1.078.14 1.604.43.518.294.98.664 1.398 1.1.405.443.737.942.98 1.492.246.55.365 1.085.365 1.606v12.187c0 .428-.177.767-.525 1.006-.354.246-.705.37-1.072.37-.336 0-.646-.07-.92-.203-.275-.143-.473-.377-.597-.716-.035-.03-.073-.133-.135-.317v-11h-.73v29.418c-.13.336-.202.537-.232.595-.186.43-.46.742-.827.94-.363.2-.76.298-1.19.298-.494 0-.928-.137-1.306-.41-.384-.276-.657-.625-.804-1.053-.06-.065-.106-.185-.134-.37V26.98h-.742v17.09c0 .58-.234 1.062-.707 1.442-.473.39-.967.575-1.486.575-.488 0-.924-.13-1.308-.39-.38-.258-.63-.62-.757-1.073-.03-.065-.072-.22-.14-.46v-29.33h.003zM5.64 4.25c0-.762.204-1.45.613-2.064.42-.61.977-1.083 1.68-1.42.115-.06.267-.114.43-.156.173-.048.333-.072.485-.072h1.145c.157 0 .312.024.48.072.166.042.312.095.44.156.666.306 1.22.773 1.646 1.4.426.625.64 1.322.64 2.085 0 1.04-.358 1.932-1.076 2.68-.715.75-1.61 1.125-2.686 1.125-1.062 0-1.962-.367-2.7-1.1C6.003 6.222 5.64 5.318 5.64 4.25z" fill-rule="nonzero" fill="#000" opacity=".7"/></svg>
                            <h1>{{ number_format($beneficiarios,0) }}</h1> <p>personas beneficiadas</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg class="pull-left" style="height:100px" viewBox="0 0 36 47" xmlns="http://www.w3.org/2000/svg"><title>Group</title><g fill-rule="nonzero" fill="#000" opacity=".7"><path d="M17.68 35.4c-1.74 0-5.82 0-5.82-4.604v-.76c-2.633-1.97-4.228-5.2-4.228-8.63 0-5.834 4.48-10.576 9.99-10.576 5.507 0 9.99 4.742 9.99 10.575 0 3.425-1.52 6.555-4.11 8.542v.85c0 4.603-3.788 4.603-5.822 4.603M21.945 39.485h-8.3c-.782 0-1.414-.67-1.414-1.493 0-.827.633-1.498 1.414-1.498h8.3c.784 0 1.415.67 1.415 1.498 0 .824-.63 1.493-1.415 1.493M17.73 46.063c-2.27 0-4.168-1.297-4.508-3.08l-.342-1.792h9.7l-.35 1.793c-.335 1.784-2.23 3.08-4.5 3.08M17.73 8.35c-.783 0-1.416-.67-1.416-1.497v-4.59c0-.83.633-1.5 1.416-1.5.783 0 1.41.67 1.41 1.5v4.59c0 .825-.626 1.496-1.41 1.496M24.936 9.984c-.287 0-.572-.092-.824-.278-.635-.484-.78-1.418-.323-2.087l2.526-3.73c.456-.67 1.337-.822 1.972-.34.638.48.78 1.416.327 2.084l-2.53 3.73c-.277.406-.71.62-1.15.62M30.186 17.36c-.573 0-1.112-.37-1.32-.967-.276-.778.093-1.638.826-1.93l4.057-1.61c.728-.292 1.546.104 1.82.876.27.77-.096 1.63-.83 1.924l-4.06 1.612c-.16.065-.328.093-.494.093M5.807 17.36c-.168 0-.336-.03-.496-.094l-4.063-1.612C.517 15.36.147 14.5.423 13.73c.272-.774 1.09-1.166 1.822-.877l4.057 1.61c.73.292 1.1 1.152.825 1.93-.21.598-.75.966-1.32.966M10.85 9.984c-.44 0-.872-.214-1.147-.62l-2.53-3.73c-.455-.67-.31-1.606.324-2.086.634-.48 1.518-.33 1.972.34L12 7.618c.454.67.31 1.604-.327 2.087-.247.187-.537.28-.824.28"/></g></svg>
                            <h1>{{ number_format($sistemas,0) }}</h1> <p>total sistemas instalados</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg class="pull-left" style="height:100px" viewBox="0 0 27 50" xmlns="http://www.w3.org/2000/svg"><title>Potencia</title><path d="M11.25.5L26.916.376 16 15.25l10.512.095L.638 50 10.77 20.93l-10.727.867" fill-rule="nonzero" fill="#000" opacity=".7"/></svg>
                            <h1>{{ number_format($potencia,0) }}</h1> <p>potencia instalada (kW)</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg class="pull-left" style="height:100px" viewBox="0 0 21 49" xmlns="http://www.w3.org/2000/svg"><title>Energia</title><g fill-rule="nonzero" fill="#000" opacity=".7"><path d="M.77 45.527v-5.58l5.213.61v5.842M.77 38.202v-5.666l5.213.434v5.842M.77 30.964v-5.406h5.213v5.877M8.05 31.662v-6.104h5.217v6.386M8.05 39.09v-5.944l5.217.432v6.115M8.05 46.748V40.79l5.217.604v6.255M15.424 48.014l5.035.856v-6.643l-5.036-.584M15.424 39.946V33.76l5.035.42v6.345M15.424 31.944v-6.386h5.035v6.976M.77 3.842v5.58l5.213-.608V2.97M.77 11.167v5.668l5.213-.435v-5.84M.77 18.406v5.406h5.213v-5.875M8.05 17.708v6.104h5.217v-6.385M8.05 10.282v5.944l5.217-.433V9.677M8.05 2.62v5.962l5.217-.605V1.72M15.424 1.355L20.46.5v6.646l-5.036.583M15.424 9.423v6.19l5.035-.42V8.846M15.424 17.427v6.385h5.035v-6.977"/></g></svg>
                            <h1>{{ number_format($energia,1) }}</h1> <p>energia generada (MWh)</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg class="pull-left" style="height:100px" viewBox="0 0 51 47" xmlns="http://www.w3.org/2000/svg"><title>Group</title><g fill-rule="nonzero" fill="#000" opacity=".7"><path d="M9.845 29.32c-.193-.515-.296-1.07-.296-1.65 0-2.674 2.23-4.84 4.984-4.84 1.24 0 2.376.44 3.248 1.168 1.828-1.654 4.392-2.687 7.23-2.687 5.556 0 10.058 3.94 10.058 8.8 0 .234-.013.466-.033.697 2.632.498 4.683 2.575 5.063 5.174l9.845 3.585-10.812.66c-1.134 1.685-3.092 2.8-5.32 2.8-.82 0-1.602-.153-2.32-.427-.815 2.494-3.217 4.302-6.057 4.302-2.886 0-5.323-1.87-6.096-4.428-1.542 1.592-3.73 2.59-6.158 2.59-4.668 0-8.452-3.674-8.452-8.204 0-3.38 2.107-6.282 5.115-7.538M.167 26.194c0 1.812 1.515 3.28 3.38 3.28 1.866 0 3.38-1.468 3.38-3.28 0-1.812-1.514-3.282-3.38-3.282-1.865 0-3.38 1.47-3.38 3.282M.673 18.81c0 .544.455.985 1.016.985.56 0 1.013-.44 1.013-.984 0-.542-.454-.983-1.014-.983-.562 0-1.017.44-1.017.984M19.774 18.236c0 1.043.87 1.888 1.943 1.888s1.943-.845 1.943-1.888c0-1.042-.87-1.886-1.943-1.886s-1.943.844-1.943 1.886M36.677 17.334c0 .997.833 1.806 1.86 1.806 1.025 0 1.858-.81 1.858-1.806 0-.997-.833-1.806-1.86-1.806-1.025 0-1.858.81-1.858 1.806M28.396 14.956c0 .498.415.902.928.902.515 0 .932-.404.932-.902 0-.5-.417-.903-.932-.903-.513 0-.928.403-.928.903M36.677 26.194c0 .498.417.9.93.9.513 0 .93-.402.93-.9 0-.5-.417-.903-.93-.903-.513 0-.93.404-.93.904M20.112 9.95c0 .59.49 1.067 1.1 1.067.607 0 1.098-.477 1.098-1.066 0-.588-.49-1.065-1.1-1.065-.607 0-1.098.477-1.098 1.066M11.49 5.686c0 .453.38.82.847.82.467 0 .846-.367.846-.82 0-.454-.38-.82-.846-.82-.468 0-.846.366-.846.82M18.253 2.65c0 .997.832 1.806 1.86 1.806 1.024 0 1.857-.81 1.857-1.806 0-.997-.833-1.806-1.858-1.806-1.027 0-1.86.81-1.86 1.806M28.9 8.393c0 .725.606 1.312 1.355 1.312.745 0 1.35-.587 1.35-1.312 0-.726-.604-1.313-1.35-1.313-.748 0-1.354.587-1.354 1.313M6.314 12.515c-.305-.424-.484-.94-.484-1.497 0-1.45 1.21-2.625 2.704-2.625 1.145 0 2.12.69 2.516 1.667.405-.125.838-.19 1.286-.19 2.38 0 4.312 1.873 4.312 4.184 0 2.312-1.93 4.185-4.312 4.185-.973 0-1.87-.316-2.595-.845-.487.325-1.077.514-1.715.514-1.68 0-3.04-1.323-3.04-2.953 0-1.017.526-1.91 1.33-2.442"/><path d="M50.452 38.008l-7.268-6.81s-.718-.45-1.184 0c-.465.452.677 1.477.677 1.477l7.775 5.333zM50.678 37.75l-.747-4.912s-.144-.396-.474-.355c-.33.04-.2.794-.2.794l1.422 4.474zM50.9 40.324l-6.43 4.257s-.463.457-.185.87c.278.41 1.254-.267 1.254-.267l5.36-4.86z"/></g></svg>
                            <h1>{{ number_format($co2,0) }}</h1> <p>Tons CO2 evitadas</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg class="pull-left" style="height:100px" viewBox="0 0 39 41" xmlns="http://www.w3.org/2000/svg"><title>Equipo</title><g fill-rule="nonzero" fill="#000" opacity=".8"><path d="M12.036 37.826c.392 0 .84-.093 1.335-.275 4.198-1.56 11.162-9.667 14.787-15.968 2.494-4.336 2.162-5.58 2-5.858-.063-.11-.192-.26-.566-.26-.935 0-2.82 1.42-3.44 1.886-1.055.793-2.225 1.756-3.462 2.775-2.473 2.035-5.03 4.14-7.276 5.418-.185.125-2.84 1.91-5.854 3.127l-.016.006c-.124.05-.25.1-.375.148-.024.008-.047.018-.07.027l-.254.093c-.052.02-.103.04-.153.057-.062.02-.126.043-.188.064-.07.024-.14.05-.207.07l-.153.05c-.08.024-.158.05-.235.074-.046.015-.09.026-.137.04-.083.025-.163.05-.245.07l-.13.037c-.083.02-.166.043-.247.063l-.128.03c-.086.022-.17.04-.256.06-.037.007-.074.016-.112.022-.12.025-.24.05-.36.07-.265.046-.534.08-.793.104-.13.012-.255.02-.38.023l-.114.004c-.056 0-.11.004-.165.004h-.09c-.04-.003-.08-.003-.117-.005-.086-.003-.17-.007-.254-.015l-.096-.007c-.226-.02-.443-.054-.65-.1-.026-.008-.052-.015-.078-.02-.076-.02-.15-.04-.225-.063-.027-.01-.057-.02-.086-.027-.074-.024-.145-.05-.215-.08-.024-.008-.05-.017-.07-.026-.09-.038-.182-.08-.267-.124 0-.002-.002-.002-.003-.002 2.53 4.377 6.354 8.51 9.346 8.51z"/><path d="M1.804 27.672c.58 1.038 1.573 1.543 3.035 1.543.193 0 .398-.01.608-.027.242-.02.493-.055.745-.1.124-.02.25-.045.377-.07.04-.01.084-.022.126-.03.085-.02.17-.038.256-.06.05-.012.1-.025.15-.04l.233-.06c.054-.016.107-.03.16-.047.076-.02.152-.042.23-.065l.162-.053.228-.072c.055-.02.107-.037.163-.056.076-.026.152-.054.23-.08.052-.02.105-.038.158-.056l.237-.09.148-.057c.087-.032.17-.066.255-.1.044-.02.087-.036.13-.053.104-.044.21-.087.314-.132.02-.01.04-.02.063-.027.126-.055.253-.11.377-.166.027-.014.055-.025.082-.037.098-.043.193-.088.29-.133l.125-.06.238-.112c.045-.02.09-.044.136-.066.075-.036.147-.07.22-.108.047-.022.094-.045.138-.068l.21-.105c.046-.024.09-.048.135-.07.07-.035.14-.07.207-.107l.127-.065.203-.11.078-.04-.06.005-.06.004c-.076.006-.15.01-.224.01-2.062 0-4.428-1.538-6.515-2.896l-.385-.25c-.837-.54-1.72-1.102-2.504-1.475-.65-.31-1.173-.46-1.596-.462H1.02c-.044 0-.085.004-.126.01l-.025.003-.094.02-.033.01-.078.03c-.004.003-.02.01-.024.01-.018.01-.042.026-.068.046l-.023.018-.048.043-.023.025c-.017.018-.03.035-.044.055l-.015.02c-.02.032-.037.064-.054.1l-.015.032-.03.08-.015.05c-.01.027-.016.055-.022.085l-.005.02c-.003.01-.005.023-.007.036-.008.046-.016.093-.02.14l-.005.045v.026c-.005.035-.008.07-.01.105 0 .03 0 .06-.002.09v.096l.003.1c0 .024.003.05.004.075l.002.023c.004.07.012.143.02.217l.01.08.02.143.013.08.027.155.013.06c.038.19.083.39.14.596l.01.04c.02.072.04.144.063.216l.005.02c.19.64.454 1.34.787 2.087.097.193.187.388.266.58l.027.056.133.27v.003c0 .002 0 .002.003.004l.024.045z"/><path d="M4.84 29.215c.193 0 .398-.01.608-.027-.21.017-.415.027-.61.027-1.46 0-2.455-.505-3.034-1.543l.004.01c.574 1.027 1.567 1.533 3.03 1.533zM12.38 26.688l-.08.04.08-.04zM1.804 27.672l-.025-.05c-.003 0-.003 0-.003-.003.01.015.017.032.024.048h.002c0 .002 0 .004.002.004z"/><path d="M1.804 27.672l-.002-.003v-.002l.002.008.004.006M8.05 20.585c0 2.14 1.755 3.894 3.92 3.894 2.14 0 3.892-1.755 3.892-3.895 0-2.165-1.753-3.918-3.892-3.918-2.165 0-3.92 1.753-3.92 3.918z"/><g><path d="M22.272 4.534c.472 0 .875-.15 1.2-.446.333-.303.503-.69.503-1.146 0-.458-.17-.844-.503-1.146-.325-.297-.73-.447-1.2-.447-.476 0-.877.16-1.19.474-.315.315-.475.69-.475 1.12 0 .427.16.804.474 1.118.315.313.717.472 1.192.472zm-.788-2.307c.207-.207.465-.307.788-.307.33 0 .596.098.815.297.212.193.314.43.314.725 0 .293-.102.53-.312.724-.22.2-.487.298-.816.298-.323 0-.58-.1-.788-.307-.205-.206-.306-.44-.306-.715 0-.276.1-.51.306-.715zM27.9 5.58c.563.47 1.19.71 1.862.71.042 0 .083 0 .124-.003.73-.03 1.347-.336 1.823-.906.477-.57.67-1.228.572-1.954-.098-.716-.45-1.332-1.045-1.83-.598-.502-1.27-.725-1.994-.66-.724.063-1.318.367-1.766.9-.448.535-.642 1.174-.577 1.897.064.724.402 1.345 1 1.847zm.017-3.376c.352-.42.802-.65 1.377-.7.064-.005.13-.008.19-.008.502 0 .956.176 1.388.537.49.41.766.89.845 1.47.077.567-.068 1.06-.444 1.51-.375.45-.837.68-1.41.703-.58.024-1.103-.162-1.594-.573-.486-.407-.747-.885-.8-1.46-.05-.576.094-1.06.447-1.48zM37.973 7.713c-.146-.614-.476-1.08-.976-1.387-.498-.307-1.035-.396-1.582-.266-.548.133-.982.453-1.288.953-.308.502-.388 1.066-.24 1.68.145.608.465 1.083.946 1.41.345.234.72.352 1.116.352.163 0 .334-.02.506-.062.585-.14 1.027-.475 1.314-.994.28-.513.35-1.08.203-1.687zm-.704 1.41c-.21.377-.518.61-.946.715-.43.103-.81.035-1.17-.207-.364-.248-.598-.598-.71-1.07-.113-.467-.058-.874.17-1.246.23-.372.534-.6.937-.696.12-.03.24-.043.354-.043.273 0 .534.078.795.238.372.23.606.566.72 1.033.11.472.062.888-.15 1.277zM21.32 7.57c-1.93 0-3.816.336-5.614.995-3.912-1.24-7.604-.592-10.142 1.792-2.667 2.506-3.8 6.632-3.117 11.344l.562.263c.025-.053.038-.113.028-.176-.707-4.595.356-8.607 2.918-11.013 2.232-2.097 5.436-2.76 8.884-1.865-.194.084-.39.172-.58.263l-.022.013c-.2.096-.395.195-.59.3-.063.034-.128.07-.19.106-.14.075-.274.15-.408.23l-.223.135c-.122.075-.245.152-.366.23-.074.05-.15.1-.225.148-.12.08-.238.164-.356.248-.07.05-.143.1-.214.152-.125.093-.25.188-.373.285-.06.046-.118.09-.176.137-.18.145-.358.293-.535.446-1.097.958-2.06 2.06-2.865 3.27l-.02.034-.103.15c-.306.476-.59.97-.844 1.473l-.03.056c-.335.668-.63 1.38-.876 2.108-.098.294-.175.54-.24.78l-.022.085c-.16.584-.29 1.176-.382 1.76l-.004.018c-.023.148-.043.297-.062.446-.014.098-.023.193-.033.29-.005.054-.013.106-.02.162-.01.105-.018.212-.026.318-.003.045-.01.09-.012.137-.01.12-.014.243-.02.365l-.008.092v.01l.52.322v-.003c.01-.013.013-.027.02-.04l.013-.028c.01-.024.014-.05.015-.077.022-.644.084-1.285.18-1.9l.004-.022c.088-.562.213-1.134.367-1.7l.022-.083c.064-.227.138-.465.234-.75.234-.704.52-1.39.843-2.034l.028-.053c.246-.484.52-.963.816-1.42.03-.05.063-.098.096-.146l.022-.035c.776-1.167 1.707-2.23 2.767-3.156 1.418-1.238 3.02-2.2 4.76-2.863 1.034.346 2.078.825 3.105 1.432 2.19 1.297 4.258 3.154 5.976 5.377.15.19.297.388.443.59 0 .002 0 .003.002.004.146.2.29.406.432.614l.064.094.475-.32c-.31-.46-.633-.906-.963-1.333-.108-.145-.22-.284-.333-.423l-.01-.01-.15-.183c-.06-.075-.12-.148-.184-.223l-.03-.032c-.068-.083-.14-.164-.21-.245-.037-.04-.072-.084-.11-.125l-.175-.194c-.06-.066-.12-.135-.18-.2l-.098-.103c-.035-.036-.07-.07-.104-.108l-.23-.237-.04-.042-.202-.203c-.113-.113-.23-.224-.344-.334l-.098-.095c-.024-.02-.046-.042-.07-.064-.02-.018-.038-.033-.056-.053-.086-.078-.17-.158-.257-.235-.032-.03-.064-.06-.1-.087-.01-.01-.024-.02-.037-.032l-.25-.222h-.003c-.04-.036-.083-.07-.125-.106-.006-.004-.01-.01-.018-.014-.083-.07-.166-.143-.25-.21-.002 0-.002 0-.003-.002l-.087-.07c-.02-.015-.036-.03-.056-.044l-.124-.1c-.22-.174-.438-.34-.66-.502l-.03-.02-.195-.143c-.06-.043-.12-.086-.183-.128l-.033-.022c-.085-.06-.17-.117-.254-.174-.05-.032-.1-.062-.15-.096l-.014-.01-.09-.058c-.102-.064-.202-.13-.303-.19l-.024-.016-.247-.15-.02-.01-.008-.005s0-.002-.003-.002l-.014-.01c-.008-.004-.016-.006-.023-.012l-.02-.01c-.156-.093-.316-.183-.476-.27l-.054-.03-.023-.012c-.022-.012-.046-.023-.067-.036-.153-.08-.307-.16-.46-.236l-.018-.01-.028-.014c-.183-.09-.366-.177-.55-.26-.003 0-.007-.002-.01-.004-.026-.01-.05-.023-.077-.034-.018-.008-.035-.016-.054-.023-.144-.06-.286-.122-.43-.18l-.037-.015-.043-.02c-.015-.005-.03-.01-.043-.017-.023-.01-.048-.02-.07-.026-.01-.005-.02-.01-.033-.014 1.53-.484 3.123-.73 4.744-.73 8.688 0 15.753 7.067 15.753 15.754 0 7.51-5.278 13.807-12.32 15.377l.2-.106.163-.086c.08-.044.155-.092.235-.14.048-.027.097-.055.144-.084.086-.054.17-.11.256-.167.036-.026.076-.05.114-.076.12-.084.24-.17.355-.262.22-.17.436-.354.64-.545.31-.292.603-.61.874-.946.133-.165.264-.338.388-.515.183-.262.354-.54.515-.823.105-.19.208-.384.303-.58.047-.1.093-.197.138-.3.748-1.678 1.112-3.612 1.1-5.68-.006-.825-.073-1.672-.2-2.532-.084-.573-.195-1.152-.333-1.736-.068-.29-.145-.582-.226-.875-.207-.732-.455-1.467-.744-2.2l-.083-.212-.367.63c.355.93.642 1.855.86 2.772.067.283.128.564.183.844.055.28.103.56.143.836.124.833.19 1.65.197 2.45.017 1.996-.332 3.86-1.052 5.473-.04.095-.085.187-.13.282-.09.186-.186.37-.285.547-.15.267-.314.528-.486.774-.116.166-.24.33-.364.485-.25.314-.528.613-.82.886-.19.18-.39.35-.597.51-.223.173-.452.333-.69.48-.71.442-1.49.772-2.323.985-.158.04-.32.076-.48.108-.067.012-.136.02-.203.034-.097.017-.19.034-.29.05l-.125.013c-.126.015-.25.032-.374.043-.04.004-.078.004-.117.007-.13.01-.258.018-.387.023-1.815-.05-3.59-.406-5.262-1.058-.604-.254-1.216-.56-1.82-.905l-.697.254.223.13c.687.405 1.384.758 2.08 1.05 1.747.68 3.59 1.05 5.48 1.1h.005c.145.004.288.007.43.007 9.004 0 16.327-7.324 16.327-16.325 0-9-7.324-16.32-16.327-16.32z"/></g></g></svg>
                            <h1>{{ number_format($equipo,0) }}</h1> <p>Equipo <strong>ilu</strong>méxico</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg class="pull-left" style="height:100px" viewBox="0 0 33 40" xmlns="http://www.w3.org/2000/svg"><title>Group</title><g fill-rule="nonzero" fill="#414042" opacity=".8"><path d="M17.37 24.01c0 2.582-2.19 4.676-4.89 4.676-2.7 0-4.89-2.094-4.89-4.676 0-2.58 2.19-4.674 4.89-4.674 2.7 0 4.89 2.093 4.89 4.674M22.928.165C17.556.165 13.2 4.33 13.2 9.468c0 2.452.995 4.682 2.617 6.343v2.91l1.637-1.563c1.56 1.016 3.444 1.613 5.474 1.613 5.372 0 9.728-4.164 9.728-9.302 0-5.137-4.356-9.303-9.728-9.303M23.886 28.213c0 1.277-1.084 2.312-2.42 2.312-1.335 0-2.42-1.035-2.42-2.312s1.085-2.314 2.42-2.314c1.336-.002 2.42 1.036 2.42 2.313M17.37 34.492c0-2.582-2.19-4.676-4.89-4.676-2.633 0-4.773 1.993-4.878 4.487h-.01v.189c0 .033.004.065.005.098l.068 3.715c4.814 1.947 9.738 0 9.738 0l-.034-3.813zM24.034 34.587v-1.082c0-1.26-1.095-2.283-2.444-2.283-1.35 0-2.444 1.022-2.444 2.283v4.092s3.184-1.38 4.888-3.01M1.124 28.213c0 1.277 1.084 2.312 2.42 2.312 1.335 0 2.42-1.035 2.42-2.312S4.878 25.9 3.543 25.9c-1.336-.002-2.42 1.036-2.42 2.313M.977 34.587v-1.082c0-1.26 1.094-2.283 2.443-2.283 1.35 0 2.444 1.022 2.444 2.283v4.092s-3.184-1.38-4.887-3.01"/></g></svg>
                            <h1>{{ number_format($embajadores,0) }}</h1> <p>Embajadores</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg class="pull-left" style="height:100px" viewBox="0 0 35 35" xmlns="http://www.w3.org/2000/svg"><title>Shape</title><path d="M25.754.787c-2.287 0-4.443.863-6.06 2.436L13.26 9.46c-1.623 1.567-2.51 3.657-2.51 5.875 0 2.84 1.477 5.458 3.956 6.997.37.232.812.298 1.212.21.405-.085.77-.317 1.005-.677.242-.366.31-.787.22-1.177-.087-.392-.33-.746-.705-.98-1.55-.964-2.474-2.6-2.474-4.373 0-1.392.558-2.695 1.568-3.673l6.433-6.237c1.014-.98 2.36-1.522 3.788-1.522 2.958 0 5.36 2.334 5.36 5.197 0 1.39-.557 2.693-1.572 3.674l-3.043 2.957c-.326.31-.483.72-.477 1.132.01.39.168.777.477 1.07.314.304.722.457 1.134.457.408 0 .82-.154 1.138-.457l3.052-2.958c1.617-1.562 2.51-3.654 2.51-5.875 0-4.582-3.847-8.313-8.576-8.313m-6.096 11.706c-.378-.233-.812-.295-1.22-.206-.398.084-.763.318-1.006.68-.24.363-.302.783-.215 1.17.09.39.33.75.7.98 1.552.964 2.478 2.602 2.478 4.374 0 1.392-.555 2.694-1.572 3.675L12.397 29.4c-1.015.985-2.358 1.52-3.795 1.52-2.95 0-5.356-2.327-5.356-5.195 0-1.383.56-2.688 1.57-3.674l3.05-2.957c.326-.308.478-.718.47-1.13-.005-.385-.16-.777-.47-1.072-.314-.302-.727-.454-1.134-.454-.415 0-.823.152-1.138.455l-3.05 2.96c-1.62 1.568-2.51 3.658-2.51 5.875 0 4.588 3.844 8.317 8.567 8.317 2.295 0 4.45-.868 6.068-2.436L21.1 25.37c1.617-1.57 2.512-3.658 2.512-5.88 0-2.842-1.48-5.455-3.954-6.997" fill-rule="nonzero" fill="#414042" opacity=".8"/></svg>
                            <h1>{{ number_format($enlaces,0) }}</h1> <p>Enlaces comunitarios</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body text-right">
                            <svg class="pull-left" style="height:100px" viewBox="0 0 41 39" xmlns="http://www.w3.org/2000/svg"><title>Group</title><g fill-rule="nonzero" fill="#414042" opacity=".8"><path d="M20.62 16.71c-.595 0-1.126.237-1.516.626-.39.39-.63.922-.63 1.516 0 .593.24 1.125.63 1.515.39.39.92.627 1.515.627.59 0 1.123-.238 1.512-.627.39-.39.628-.922.628-1.515 0-.594-.238-1.127-.628-1.516-.39-.39-.92-.627-1.513-.627z"/><path d="M40.32 33.323c-.123-.124-.297-.197-.474-.197h-1.254v-14.73c0-.255-.142-.486-.37-.603L22.874 10.12h3.965c.176 0 .347-.07.472-.194.125-.125.197-.3.197-.477V5.047c0-.177-.073-.35-.198-.476-.125-.125-.296-.197-.473-.197h-1.014v-.938c0-.176-.07-.35-.195-.474-.125-.126-.3-.198-.477-.198h-2.955v-.44c0-.943-.766-1.706-1.71-1.706-.467 0-.897.19-1.206.5-.307.306-.5.738-.5 1.206V9.74l-16.11 8.053c-.23.116-.375.348-.375.604v14.73H1.192c-.177 0-.35.072-.475.196-.125.124-.195.298-.195.476v3.552c0 .178.07.35.195.476.126.124.298.197.475.197h16.514c.176 0 .35-.073.473-.197.062-.063.11-.136.145-.218v-8.553h4.44v8.63c.03.05.053.1.093.14.125.125.297.198.474.198h16.514c.177 0 .35-.073.474-.197.126-.125.2-.298.2-.476V33.8c0-.18-.074-.353-.2-.477zm-30.727-2.12H4.7v-4.89h4.893v4.89zm5.77 0h-4.89v-4.89h4.89v4.89zm5.256-8.867c-1.927 0-3.487-1.56-3.487-3.484 0-1.926 1.56-3.486 3.486-3.486 1.924 0 3.483 1.56 3.483 3.486 0 1.923-1.562 3.483-3.484 3.484zm9.71 8.77h-4.89v-4.89h4.89v4.89zm5.772 0h-4.89v-4.89h4.89v4.89z"/></g></svg>
                            <h1>{{ number_format($escuelas,0) }}</h1> <p>ILUEscuelas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    (function(){

    });
</script>
@endsection

