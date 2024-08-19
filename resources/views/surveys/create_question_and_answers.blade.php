<form action="{{ route('questions.store', $survey->id) }}" method="POST">
    @csrf

    <div>
        <label for="question_text">Question Text:</label>
        <input type="text" name="question_text" id="question_text" required>
    </div>

    <div>
        <label for="question_type">Question Type:</label>
        <select name="question_type" id="question_type" required>
            <option value="multiple_choice">Multiple Choice</option>

        </select>
    </div>

    <div>
        <label>Answers:</label>
        <div>
            <input type="text" name="answers[0][answer_text]" required>
            <label>
                <input type="checkbox" name="answers[0][is_correct]" value="1">
                Correct
            </label>
        </div>
        <div>
            <input type="text" name="answers[1][answer_text]" required>
            <label>
                <input type="checkbox" name="answers[1][is_correct]" value="1">
                Correct
            </label>
        </div>
        <div>
            <input type="text" name="answers[2][answer_text]" required>
            <label>
                <input type="checkbox" name="answers[2][is_correct]" value="1">
                Correct
            </label>
        </div>
        <div>
            <input type="text" name="answers[3][answer_text]" required>
            <label>
                <input type="checkbox" name="answers[3][is_correct]" value="1">
                Correct
            </label>
        </div>
        <!-- Add more answers as needed -->
    </div>

    <button type="submit">Add Question and Answers</button>
</form>
