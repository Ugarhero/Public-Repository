package com.example.demo.Controllers;

import com.example.demo.Models.Joke;
import com.example.demo.Services.JokeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;

import java.util.Comparator;
import java.util.List;


/**
 * @author Tomislav Dananić
 * @version 1.0
 */
@Controller
public class IndexController {

    @Autowired
    JokeService jokeService;

    /**
     * Redirects to index page and sends a model containing a list
     * of all jokes
     * @param model
     * @return index
     */
    @RequestMapping(value = "/")
    public String getAllJokes(Model model) {
        List<Joke> jokes = jokeService.getAllJokes();
        jokes.sort((t0, t1) -> -((t0.getLikes() - t0.getDislikes()) - (t1.getLikes() - t1.getDislikes())));

        model.addAttribute("jokes", jokes);
        return "Index";
    }

    /**
     * Redirects to InputJoke page
     * @return InputJoke
     */
    @RequestMapping(value = "/new")
    public String getInputJoke() {
        return "InputJoke";
    }

    /**
     * Increases number of dislikes for a joke with id
     * and redirects to index page
     * @param id
     * @return index
     */
    @RequestMapping(value = "/vote", params = "dislike", method = RequestMethod.POST)
    public ModelAndView dislikeJoke(@RequestParam(value = "id") Integer id) {
        Joke joke = jokeService.getJoke(id);
        joke.setDislikes(joke.getDislikes() + 1);
        jokeService.store(joke);
        ModelAndView view = new ModelAndView("redirect:/");
        return view;

    }

    /**
     * Increases number of likes for a joke with id
     * and redirects to index page
     * @param id
     * @return
     */
    @RequestMapping(value = "/vote", params = "like", method = RequestMethod.POST)
    public ModelAndView likeJoke(@RequestParam(value = "id") Integer id) {
        Joke joke = jokeService.getJoke(id);
        joke.setLikes(joke.getLikes() + 1);
        jokeService.store(joke);
        ModelAndView view = new ModelAndView("redirect:/");
        return view;
    }


}
