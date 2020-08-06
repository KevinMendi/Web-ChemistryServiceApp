<br><br>
<div class="col-md-4" style="margin-top:-1em;">
				<div class="answer-box" disabled>
				<label>Answer</label><br>
				<input type="text" name="results"  id="myText" value="<?php echo "".$_SESSION['answer']." ".$_SESSION['answerUnit'] ?>" readonly> 
			     </div>
                <br>
    
    
                
</div>

<div class="row">
			<div class="col-md-2">
				
					<label>Mass</label>
				
			</div>
			<div class="col-md-4">
				<input type="text" name="massValue"><br>
			</div>
			<div class="col-md-6">
				<select name="massUnit" >
					<option selected>---Select the Unit---</option>
					<option>carat</option>
					<option>ounce</option>
					<option>pound</option>
					<option>short ton</option>
					<option>long ton</option>
					<option>milligram</option>
					<option>gram</option>
					<option>kilogram</option>
				</select>
			</div>
</div>

<div class="row">
			<div class="col-md-2">
				
					<label>Volume</label>
				
			</div>
			<div class="col-md-4">
				<input type="text" name="volumeValue"><br>
			</div>
			<div class="col-md-6">
				<select name="volumeUnit" >
					<option selected>---Select the Unit---</option>
					<option >cubic inch</option>
					<option>cubic yard</option>
					<option>cubic foot</option>
					<option>cubic meter</option>
					<option>cubic millimeter</option>
					<option>cubic centimeter</option>
					<option>cubic mile</option>
					<option>cubic kilometer</option>
					<option>liter</option>
					<option>milliliter</option>
					<option>pint</option>
					<option>quart</option>
					<option>gallon</option>
				</select>
			</div>
</div>

<div class="row">


                    <div class="col-md-6">
					<button type="submit" name="calculate-btn"  class="btn btn-success btn-lg btn-block mb-1 mt-2" >Calculate</button>
                    </div><br>
                    <div class="col-md-6">
					<button type="submit" name="calc-clear"  class="btn btn-success btn-lg btn-block mb-1 mt-2" >Clear</button>
                    </div>

			</div>




<br><br>