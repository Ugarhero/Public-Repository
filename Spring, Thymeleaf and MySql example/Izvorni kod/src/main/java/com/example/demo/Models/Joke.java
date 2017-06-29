package com.example.demo.Models;

import javax.persistence.*;

/**
 * @author Tomislav Dananić
 * @version 1.0
 */
@Entity
@Table(name = "Joke")
public class Joke {

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    @Column(name = "id")
    private int id;

    @Column(name = "content")
    private String content;

    @Column(name = "likes")
    private int likes;

    @Column(name = "dislikes")
    private int dislikes;

    public Joke(String content, int likes, int dislikes) {
        this.content = content;
        this.likes = likes;
        this.dislikes = dislikes;
    }

    public Joke() {
    }

    /**
     *
     * @return Joke id
     */
    public int getId() {
        return id;
    }

    /**
     * Set id for a Joke
     * @param id
     */
    public void setId(int id) {
        this.id = id;
    }

    /**
     * Get content of a Joke
     * @return content
     */
    public String getContent() {
        return content;
    }

    /**
     * Set content of a Joke
     * @param content
     */
    public void setContent(String content) {
        this.content = content;
    }

    /**
     * Get number of likes for a Joke
     * @return likes
     */
    public int getLikes() {
        return likes;
    }

    /**
     * Set number of likes for a Joke
     * @param likes
     */
    public void setLikes(int likes) {
        this.likes = likes;
    }

    /**
     * Get number of dislikes for a Joke
     * @return dislikes
     */
    public int getDislikes() {
        return dislikes;
    }

    /**
     * Set numer of dislikes for a Joke
     * @param dislikes
     */
    public void setDislikes(int dislikes) {
        this.dislikes = dislikes;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        Joke joke = (Joke) o;

        return id == joke.id;
    }

    @Override
    public int hashCode() {
        int result = id;
        result = 31 * result + (content != null ? content.hashCode() : 0);
        result = 31 * result + likes;
        result = 31 * result + dislikes;
        return result;
    }

    @Override
    public String toString() {
        return "Joke{" +
                "id=" + id +
                ", content='" + content + '\'' +
                ", likes=" + likes +
                ", dislikes=" + dislikes +
                '}';
    }
}
