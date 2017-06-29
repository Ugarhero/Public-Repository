package com.example.demo.Controllers;

import com.example.demo.Models.Joke;
import com.example.demo.Services.JokeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;

/**
 * Created by tomi on 29.05.17..
 */

@Controller
public class inputDataController {

    @Autowired
    JokeService jokeService;

    @PostMapping(value = "/input")
    public ModelAndView inputData(@RequestParam(value = "content") String content){
        jokeService.store(new Joke(content,0,0));
        ModelAndView view = new ModelAndView("redirect:/");
        return view;
    }
}
