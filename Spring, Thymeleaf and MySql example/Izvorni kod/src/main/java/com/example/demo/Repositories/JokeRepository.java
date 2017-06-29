package com.example.demo.Repositories;

import com.example.demo.Models.Joke;
import org.springframework.data.repository.CrudRepository;

import java.util.List;

/**
 * @author Tomislav Dananić
 * @version 1.0
 */
public interface JokeRepository extends CrudRepository<Joke, Integer> {

    @Override
    Joke save(Joke entity);

    @Override
    List<Joke> findAll();

    @Override
    void delete(Integer integer);

}
