package com.example.demo.Services;

import com.example.demo.Models.Joke;
import com.example.demo.Repositories.JokeRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import javax.transaction.Transactional;
import java.util.List;

/**
 * @author Tomislav Dananić
 * @version 1.0
 */
@Service
@Transactional
public class JokeService {

    @Autowired
    private JokeRepository jokeRepository;

    /**
     * Stores a joke to database
     * @param joke
     */
    public void store(Joke joke) {
        jokeRepository.save(joke);
    }

    /**
     * Delete a joke from database
     * @param joke
     */
    public void delete(Joke joke) {
        jokeRepository.delete(joke.getId());
    }

    /**
     * Returns a list of all jokes in database
     * @return List
     */
    public List<Joke> getAllJokes() {
        return jokeRepository.findAll();
    }

    /**
     * Returns a joke from database with id
     * @param id
     * @return Joke
     */
    public Joke getJoke(Integer id) {
        return jokeRepository.findOne(id);
    }

}
