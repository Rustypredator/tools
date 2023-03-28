@extends('themes.default.pub.master')

@section('content')
    <div class="row">
        <div class="card bg-gradient-warning col-12" style="margin-top:25px;">
            <div class="card-header border-0">
                <h3 class="card-title"><i class="fas fa-cog mr-1"></i>WIP</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <label for="players">Comma Separated List of your Players:</label>
                <textarea name="players" id="players" class="form-control" rows="5"><?php if ($_POST and isset($_POST['players'])) echo $_POST['players']; else echo "This list has to be Comma Separated like this:\njohn doe,jane doe,max,peter,mali\n(You'll have to delete this text ;) )";?></textarea>
                <label for="teams">Number of Teams</label>
                <input type="number" id="teams" name="teams" class="form-control" <?php if ($_POST and isset($_POST['teams'])) echo 'value="'.$_POST['teams'].'"'; else echo 'value="2"';?>/>
                <br/>
                <button class="btn btn-success btn-block" onclick="teamRandomize()">Send</button>
            </div>
        </div>
    </div>
    <div class="row" id="teamsOutput">
    </div>
@stop

@section('client-js')
<script>
    function teamRandomize() {
        $('#teamsOutput').empty();
        //get names:
        var players = $('#players').val();
        var teamsCount = $('#teams').val();
        players = players.split(',');
        //randomize playerlist:
        players = players.sort(() => Math.random() - 0.5);
        teams = chunkArray(players, teamsCount);
        //write teams to ui:
        console.log(teams)
        for (i=0;i<teams.length;i++) {
            var team = teams[i];
            var playerlist = "<ul>";
            for (j in team) {
                player = team[j];
                playerlist += `<li>${player}</li>`;
            }
            playerlist += "</ul>";
            var card = `<div class="card card-primary" style="margin-left:5px;margin-right:5px;"><div class="card-header"><h4 class="card-title">Team ${i+1}:</h4></div><div class="card-body">${playerlist}</div></div>`
            $('#teamsOutput').append(card);
        }
    }
    function chunkArray(array, divider) {
        console.log("Chunking array into " + divider + " Pieces")
        var length = array.length;
        var outputArray = [];

        for (i=0;i<array.length;i+=divider) {
            divide = array.slice(i, i+divider);
            outputArray.push(divide);
        }

        return outputArray;
    }
</script>
@stop
